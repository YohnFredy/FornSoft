<?php

namespace App\Livewire\Admin\Businesses;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessData;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Image;
use App\Models\StoreType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class BusinessForm extends Component
{
    use WithFileUploads;

    public ?BusinessData $businessData;

    // Propiedades del modelo Business
    public $name = '', $slug = '', $nit = '', $user_id, $minimum_percentage = 0, $maximum_percentage = 0, $email = '', $is_active = true, $password = '';

    // Propiedades del modelo BusinessData
    public $phone = '', $whatsapp = '', $website_url = '', $business_email = '', $description = '';

    public $facebook_url = '', $instagram_url = '', $linkedin_url = '', $youtube_url = '', $tiktok_url = '', $x_url = '', $promo_video_url = '';

    public $additional_videos = [], $custom_links = [];

    // Propiedades para la ubicación
    public $country_id, $department_id, $city_id, $address;
    public $countries = [], $departments = [], $cities = [];
    public $selectedCountry = '', $selectedDepartment = '', $selectedCity = '',  $city = '';
    public $latitude = 0, $longitude = 0;

    //Estructura para manejar imágenes nuevas y existentes.
    public $newImages = [];
    public $existingImages = []; // Guardará ['id' => 'path', ...]
    public $newLogos = [];
    public $existingLogos = []; // Guardará ['id' => 'path', ...]

    // Propiedades para las categorías
    public $allCategories = [];
    public $selectedCategories = [];

    // Propiedades para las categorías
    public $allStoreTypes = [];
    public $selectedStoreTypes = [];

    public $isEditMode = false;

    protected function rules()
    {
        $businessId = $this->businessData->business->id ?? null;
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('businesses')->ignore($businessId)],
            'nit' => ['string', 'max:255', Rule::unique('businesses')->ignore($businessId)],
            'user_id' => 'exists:users,id',
            'minimum_percentage' => 'numeric|min:0|max:99',
            'maximum_percentage' => 'numeric|min:0|max:99',
            'email' => ['required', 'email', 'max:255', Rule::unique('businesses')->ignore($businessId)],
            'is_active' => 'required|boolean',
            /*  'store_type' => ['required', Rule::in(['online', 'physical', 'hybrid'])], */
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'business_email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'country_id' => 'nullable|integer',
            'department_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'x_url' => 'nullable|url|max:255',
            'promo_video_url' => 'nullable',
            'newImages.*' => 'nullable|image|max:2048',
            'newLogos.*' => 'nullable|image|max:2048',
            'selectedCategories' => 'required|array|min:1',
            'selectedCategories.*' => 'exists:business_categories,id',
            'selectedStoreTypes' => 'required|array|min:1',
            'selectedStoreTypes.*' => 'exists:store_types,id',
            'additional_videos' => 'nullable|array',
            /* 'additional_videos.*' => 'nullable',  */
            'custom_links' => 'nullable|array',
            'custom_links.*.title' => 'required_with:custom_links.*.url|string|max:255', // El título es requerido si la URL existe
            'custom_links.*.url' => 'required_with:custom_links.*.title|url|max:255',    // La URL es requerida si el título existe
        ];
    }

    public function mount(BusinessData $businessData)
    {
        $this->allCategories = BusinessCategory::all();
        $this->allStoreTypes = StoreType::all();

        $this->businessData = $businessData;

        if ($this->businessData->exists) {
            $this->isEditMode = true;
            $this->loadBusinessData();

            $this->departments = Department::where('country_id', $this->selectedCountry)->get();
            $this->cities = City::where('department_id', $this->selectedDepartment)->get();
        } else {
            $this->addVideo();
            $this->addCustomLink();
        }
        $this->countries = Country::all();
    }

    public function addVideo()
    {
        $this->additional_videos[] = '';
    }

    public function removeVideo($index)
    {
        unset($this->additional_videos[$index]);
        $this->additional_videos = array_values($this->additional_videos); // Re-indexar el array
    }

    public function addCustomLink()
    {
        $this->custom_links[] = ['title' => '', 'url' => ''];
    }

    public function removeCustomLink($index)
    {
        unset($this->custom_links[$index]);
        $this->custom_links = array_values($this->custom_links); // Re-indexar el array
    }
    public function updatedName($value)
    {
        $this->slug = Business::generateSlug($value);
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

    public function loadBusinessData()
    {
        $business = $this->businessData->business;

        $this->name = $business->name;
        $this->slug = $business->slug;
        $this->nit = $business->nit;
        $this->user_id = $business->user_id;
        $this->minimum_percentage = $business->minimum_percentage;
        $this->maximum_percentage = $business->maximum_percentage;
        $this->email = $business->email;
        $this->is_active = $business->is_active;

        $this->phone = $this->businessData->phone;
        $this->whatsapp = $this->businessData->whatsapp;
        $this->website_url = $this->businessData->website_url;
        $this->business_email = $this->businessData->business_email;
        $this->description = $this->businessData->description;
        $this->country_id = $this->selectedCountry = $this->businessData->country_id ?? '';
        $this->department_id = $this->selectedDepartment = $this->businessData->department_id ?? '';
        $this->city_id = $this->selectedCity = $this->businessData->city_id ?? '';
        $this->city = $this->businessData->city ?? '';
        $this->address = $this->businessData->address ?? '';
        $this->latitude = $this->businessData->latitude;
        $this->longitude = $this->businessData->longitude;
        $this->facebook_url = $this->businessData->facebook_url;
        $this->instagram_url = $this->businessData->instagram_url;
        $this->linkedin_url = $this->businessData->linkedin_url;
        $this->youtube_url = $this->businessData->youtube_url;
        $this->tiktok_url = $this->businessData->tiktok_url;
        $this->x_url = $this->businessData->x_url;
        $this->promo_video_url = $this->businessData->promo_video_url;

        // El modelo debería castear automáticamente de JSON a array.
        $this->additional_videos = $this->businessData->additional_videos ?? [];
        $this->custom_links = $this->businessData->custom_links ?? [];

        // Asegurarse de que haya al menos un campo visible si no hay datos
        if (empty($this->additional_videos)) $this->addVideo();
        if (empty($this->custom_links)) $this->addCustomLink();


        $this->selectedCategories = $business->categories->pluck('id')->toArray();
        $this->selectedStoreTypes = $this->businessData->storeTypes->pluck('id')->toArray();

        $this->existingImages = $business->galleryImages()->pluck('path', 'id')->toArray();
        $this->existingLogos = $business->logos()->pluck('path', 'id')->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->password = "1234567890";
        $business = $this->prepareBusiness();
        if ($this->password) {
            $business['password'] = bcrypt($this->password);
        }

        $business = Business::create($business);

        $businessData = $business->data()->create($this->prepareBusinessData());

        $business->categories()->sync($this->selectedCategories);
        $businessData->storeTypes()->sync($this->selectedStoreTypes);

        $this->saveLogos($business);
        $this->saveImages($business);

        session()->flash('success', 'Negocio creado exitosamente.');
        return redirect()->route('admin.businesses.index');
    }

    public function update()
    {
        // Preparar los datos para actualizar
        $data = $this->prepareBusiness();

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        // Obtener el modelo desde la base de datos
        $business = Business::findOrFail($this->businessData->business->id); // O usa $this->business si ya tienes el modelo

        // Actualizar el modelo con los datos preparados
        $business->update($data);

        // Actualizar relaciones, datos adicionales o imágenes si aplica...
        $business->data()->update($this->prepareBusinessData());

        $business->categories()->sync($this->selectedCategories);
        $this->businessData->storeTypes()->sync($this->selectedStoreTypes);

        $this->saveLogos($business);
        $this->saveImages($business);

        session()->flash('success', 'Negocio actualizado exitosamente.');
        return redirect()->route('admin.businesses.index');
    }

    protected function saveImages(Business $business)
    {
        if (empty($this->newImages)) {
            return;
        }

        foreach ($this->newImages as $image) {
            $path = $image->store('businesses/images', 'public');
            // CORRECCIÓN: Añadimos el tipo al crear la imagen
            $business->images()->create(['path' => $path, 'type' => 'image']);
        }
        // Limpiamos el array de imágenes nuevas para evitar re-subidas accidentales
        $this->newImages = [];
    }

    protected function saveLogos(Business $business)
    {
        if (empty($this->newLogos)) {
            return;
        }

        foreach ($this->newLogos as $logo) {
            $path = $logo->store('businesses/logos', 'public');
            // Añadimos el tipo al crear el logo
            $business->images()->create(['path' => $path, 'type' => 'logo']);
        }
        // Limpiamos el array de logos nuevos
        $this->newLogos = [];
    }

    public function removeMedia($mediaId)
    {
        $image = Image::find($mediaId);

        if (!$image) {
            return; // La imagen no existe
        }

        // Eliminar el archivo físico
        Storage::disk('public')->delete($image->path);

        // Eliminar de la base de datos
        $image->delete();

        // Actualizar el estado del componente para que la vista refleje el cambio al instante
        if (isset($this->existingImages[$mediaId])) {
            unset($this->existingImages[$mediaId]);
        }

        if (isset($this->existingLogos[$mediaId])) {
            unset($this->existingLogos[$mediaId]);
        }
    }

    private function prepareBusiness()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'nit' => $this->nit,
            'user_id' => $this->user_id,
            'minimum_percentage' => $this->minimum_percentage,
            'maximum_percentage' => $this->maximum_percentage,
            'email' => $this->email,
            'is_active' => $this->is_active,
        ];
    }

    private function prepareBusinessData()
    {
        // *** FILTRAR VALORES VACÍOS ANTES DE GUARDAR ***
        $filteredVideos = array_filter($this->additional_videos);
        $filteredLinks = array_filter($this->custom_links, function ($link) {
            return !empty($link['title']) && !empty($link['url']);
        });
        return [
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'website_url' => $this->website_url,
            'business_email' => $this->business_email,
            'description' => $this->description,
            'country_id' => $this->country_id ?: null,
            'department_id' => $this->department_id ?: null,
            'city_id' => $this->city_id ?: null,
            'city' => $this->city,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'linkedin_url' => $this->linkedin_url,
            'youtube_url' => $this->youtube_url,
            'tiktok_url' => $this->tiktok_url,
            'x_url' => $this->x_url,
            'promo_video_url' => $this->promo_video_url,

            // *** AÑADIR NUEVOS CAMPOS AL ARRAY DE DATOS ***
            'additional_videos' => !empty($filteredVideos) ? $filteredVideos : null,
            'custom_links' => !empty($filteredLinks) ? $filteredLinks : null,
        ];
    }
    public function render()
    {
        return view('livewire.admin.businesses.business-form');
    }
}
