<?php

namespace App\Livewire;

use App\Models\Binary;
use App\Models\BinaryTotal;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\PubAffiliate;
use App\Models\PubControl;
use App\Models\Unilevel;
use App\Models\UnilevelTotal;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Log;


class Register extends Component
{
    public $sponsor = '', $side = '', $controlId, $advertising = false;

    #[Validate()]
    public $username, $name, $last_name, $dni, $email, $password, $password_confirmation;
    public $sex, $birthdate, $phone, $country_id, $department_id, $city_id, $address, $terms = false;
    public $countries = [], $departments = [], $cities = [];
    public $selectedCountry = '', $selectedDepartment = '', $selectedCity = '',  $city = '';

    public $recaptcha_token = '';

    public bool $confirmingRegistration = false;

    protected function rules()
    {
        return [
            'sponsor' => ['required', 'string', 'max:20', 'exists:users,username'],
            'side' => ['required', Rule::in(['right', 'left'])],
            'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9._-]+$/', Rule::unique('users', 'username')],
            'name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'dni' => ['required', 'string', 'max:255', Rule::unique('users', 'dni')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'sex' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:30',
            'country_id' => 'required|integer',
            'department_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'terms' => 'accepted',
        ];
    }

    public function mount($sponsor = null, $side = null)
    {
        if (!$sponsor) {
            $this->sponsor = 'master';
            $this->side = 'right';
        } else {
            $this->sponsor = $sponsor;
            $this->side = $side;
        }

        if ($this->side == 'lr') {
            $this->advertising = true;
        }

        $this->countries = Country::all();
    }

    public function updatedSelectedCountry($country_id)
    {
        $this->reset(['departments', 'selectedDepartment', 'cities', 'selectedCity', 'city']);
        $this->departments = Department::where('country_id', $country_id)->get();
        $this->country_id = $country_id;
        $this->reset('department_id', 'city_id', 'city');
    }

    public function updatedSelectedDepartment($department_id)
    {
        $this->reset(['cities', 'selectedCity', 'city']);
        $this->cities = City::where('department_id', $department_id)->get();
        $this->department_id = $department_id;
        $this->reset('city_id', 'city');
    }

    public function updatedSelectedCity($city_id)
    {
        $this->reset('city');
        $this->city_id = $city_id;
    }

    public function updatedCity()
    {
        $this->reset('city_id');
    }
    private function validateRecaptcha()
    {
        if (empty($this->recaptcha_token)) {
            return false;
        }
        try {
            $response = Http::asForm()->timeout(15)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret'),
                'response' => $this->recaptcha_token,
                'remoteip' => request()->ip()
            ]);

            $result = $response->json();

            // Verificar que la respuesta sea exitosa y el score sea aceptable
            return $result['success'] &&
                isset($result['score']) &&
                $result['score'] >= 0.5 && // Score mínimo para registro
                $result['action'] === 'user_register'; // Acción específica para registro

        } catch (\Exception $e) {
            // Log del error para debugging
            Log::error('reCAPTCHA validation error: ' . $e->getMessage());
            return false;
        }
    }

    public function save() //
    {
        if ($this->side === 'lr') {

            if (! $control = PubControl::with('user')->orderBy('total_assigned')->first()) {
                $this->side = null;
                return;
            }

            $this->controlId = $control;
            $this->sponsor = $control->user->username ?? null;

            $binary = BinaryTotal::where('user_id', $control->user_id)->first();

            if (!$binary) {
                $this->side = 'right';
            } else {
                $this->side = $binary->left_affiliates <= $binary->right_affiliates ? 'left' : 'right';
            }
        }

        $this->validate();
        // Validar reCAPTCHA
        /* if (!$this->validateRecaptcha()) {
            session()->flash('captcha', '⚠️ No se pudo verificar tu envío mediante reCAPTCHA. Esto puede ocurrir si tu conexión es inestable o si Google no pudo confirmar la seguridad del envío. Por favor, intenta nuevamente recargando la página.');
            return;
        } */

        try {
            DB::transaction(function () { // 
                // La creación del usuario y sus datos se encapsulan en un solo método para más limpieza
                $user = $this->createUserWithDataAndLogConsent();

                // El resto de la lógica de negocio MLM
                $sponsor = User::where('username', $this->sponsor)->firstOrFail();
                $this->processBinaryStructure($user->id, $sponsor->id);
                $this->processUnilevelStructure($user->id, $sponsor->id);

                // Disparar el evento de registro es una buena práctica
                event(new Registered($user));

                // Iniciar sesión con el usuario recién creado
                Auth::login($user);

                $this->confirmingRegistration = true;
            }, 5); // 5 intentos en caso de deadlock

        } catch (\Exception $e) {
            // Un log más detallado para debugging
            logger()->error('Error en el proceso de registro MLM', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $this->all() // Cuidado con datos sensibles en logs
            ]);
            $this->addError('registration', 'Ocurrió un error inesperado al procesar tu registro. Por favor, intenta de nuevo.');
        }
    }

    private function createUserWithDataAndLogConsent()
    {
        // 1. Crear el usuario principal
        $user = User::create([
            'username' => $this->username, // Es buena práctica guardar usernames en minúsculas
            'name' => $this->name,
            'last_name' => $this->last_name,
            'dni' => $this->dni,
            'email' => $this->email, // Y también los emails
            'password' => Hash::make($this->password),
        ]);

        // 2. Crear los datos adicionales del usuario
        $user->userData()->create([ // Asumiendo que tienes una relación `userData()` en el modelo User
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'address' => $this->address,
        ]);

        // 3. Crear el registro de consentimiento (La parte clave)
        $user->consentLogs()->create([
            'contract_version_accepted'       => config('legal.contract_version'),
            'privacy_policy_version_accepted' => config('legal.privacy_version'),
            'accepted_at'                     => now(),
            'ip_address'                      => request()->ip(),
            'user_agent'                      => request()->userAgent(),
            'checkbox_text'                   => config('legal.checkbox_text'), // <--- Mucho mejor así
        ]);

        if ($this->controlId && $this->advertising === true) {

            // Incrementa el total asignado en 1
            $this->controlId->increment('total_assigned');

            // Crea el afiliado asociado
            PubAffiliate::create([
                'control_id' => $this->controlId->id,
                'user_id' => $user->id,
                'side' => $this->side,
            ]);
        };

        return $user;
    }

    private function processBinaryStructure($userId, $sponsorId)
    {
        $currentSponsorId = $sponsorId;

        while (true) {
            $binary = Binary::where('sponsor_id', $sponsorId)
                ->where('side', $this->side)
                ->first();

            if (!$binary) {
                Binary::create([
                    'user_id' => $userId,
                    'sponsor_id' => $sponsorId,
                    'side' => $this->side,
                ]);
                break;
            }
            $sponsorId = $binary->user_id;
            $this->incrementBinaryAffiliates($sponsorId, $this->side);
        }

        $this->incrementBinaryAffiliates($currentSponsorId, $this->side);

        while ($binary = Binary::where('user_id', $currentSponsorId)->first()) {
            $this->incrementBinaryAffiliates($binary->sponsor_id, $binary->side);
            $currentSponsorId = $binary->sponsor_id;
        }
    }

    private function incrementBinaryAffiliates($userId, $side)
    {
        $binaryTotal = BinaryTotal::where('user_id', $userId)
            ->lockForUpdate()
            ->firstOrCreate(
                ['user_id' => $userId],
                ['left_affiliates' => 0, 'right_affiliates' => 0]
            );

        // Incrementar el campo correspondiente
        $binaryTotal->increment($side === 'left' ? 'left_affiliates' : 'right_affiliates');
    }

    private function processUnilevelStructure($userId, $sponsorId)
    {
        Unilevel::create([
            'user_id' => $userId,
            'sponsor_id' => $sponsorId,
        ]);

        // Actualizar contadores unilevel
        $this->updateUnilevelCounters($sponsorId);
    }

    private function updateUnilevelCounters($sponsorId)
    {
        $unilevelTotal = UnilevelTotal::where('user_id', $sponsorId)
            ->lockForUpdate()
            ->firstOrCreate(
                ['user_id' => $sponsorId],
                ['direct_affiliates' => 0, 'total_affiliates' => 0]
            );

        $unilevelTotal->increment('direct_affiliates');
        $unilevelTotal->increment('total_affiliates');

        while ($unilevel = Unilevel::where('user_id', $sponsorId)->first()) {
            UnilevelTotal::where('user_id', $unilevel->sponsor_id)
                ->lockForUpdate()
                ->increment('total_affiliates');

            $sponsorId = $unilevel->sponsor_id;
        }
    }

    public function updatedConfirmingRegistration()
    {
        $this->reset();
        $this->confirmingRegistration = false;
        $this->countries = Country::all();
    }

    public function redirectToHome()
    {
        return redirect('/');
        /* $this->redirect(route('dashboard', absolute: false), navigate: true);  */
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.register');
    }
}
