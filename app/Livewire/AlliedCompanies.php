<?php

namespace App\Livewire;

use App\Models\BusinessCategory;
use App\Models\BusinessData;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class AlliedCompanies extends Component
{
    use WithPagination;

    // AÑADIDO: Propiedad para el término de búsqueda
    public $search = '';

    // Propiedades para los filtros de selección
    public $categories = [];
    public $countries = [];
    public $departments = [];
    public $cities = [];
    public $storeTypes = [];

    // Propiedades para los valores seleccionados
    public $selectedCategory = '';
    public $selectedCountry = '';
    public $selectedDepartment = '';
    public $selectedCity = '';
    public $selectedStoreType = '';


    public function mount()
    {
        $this->categories = BusinessCategory::orderBy('name')->get();
        $this->countries = Country::orderBy('name')->get();
        $this->storeTypes = [
            'physical' => 'Tienda Física',
            'online' => 'Tienda en Línea',
            'hybrid' => 'Híbrida (Física y en Línea)',
        ];
        // Inicializamos departments y cities como arrays vacíos
        $this->departments = [];
        $this->cities = [];
    }

    // MODIFICADO: Se añade 'search' al array para resetear la paginación al buscar
    public function updating($property)
    {
        if (in_array($property, ['selectedCategory', 'selectedCountry', 'selectedDepartment', 'selectedCity', 'selectedStoreType', 'search'])) {
            $this->resetPage();
        }
    }

    // Se ejecuta cuando se selecciona un país
    public function updatedSelectedCountry($countryId)
    {
        $this->reset(['selectedDepartment', 'selectedCity']);
        // CORREGIDO: También resetea explícitamente los arrays de datos
        $this->departments = [];
        $this->cities = [];

        if (!empty($countryId)) {
            // Simplemente poblamos los departamentos. El render se encargará del resto.
            $this->departments = Department::where('country_id', $countryId)->orderBy('name')->get();
        }
    }

    // Se ejecuta cuando se selecciona un departamento
    public function updatedSelectedDepartment($departmentId)
    {
        // Solo necesitamos resetear la ciudad seleccionada. 
        // El método render se encargará de poblar la lista de ciudades.
        $this->reset('selectedCity');
    }

    public function loadCities()
    {
        if (empty($this->selectedDepartment)) {
            $this->cities = [];
            return;
        }

        $department = Department::find($this->selectedDepartment);
        if (!$department) return;

        // Obtenemos una lista ÚNICA de nombres de ciudad que no estén vacíos
        $this->cities = BusinessData::query()
            ->where('department_id', $this->selectedDepartment)
            ->select('city') // Seleccionamos solo el nombre de la ciudad
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct() // ¡La clave es obtener valores únicos!
            ->orderBy('city')
            ->get();
    }


    // Limpia todos los filtros y la búsqueda
    public function clearFilters()
    {
        $this->reset([
            'selectedCategory',
            'selectedCountry',
            'selectedDepartment',
            'selectedCity',
            'selectedStoreType',
            'search'
        ]);
        $this->departments = [];
        $this->cities = [];
        $this->resetPage();
    }

    public function render()
    {
        // --- INICIO DE LA LÓGICA CLAVE ---
        // Se asegura de que la lista de ciudades esté poblada en CADA render,
        // si un departamento ha sido seleccionado.
        if (!empty($this->selectedDepartment)) {
            $this->cities = BusinessData::query()
                ->where('department_id', $this->selectedDepartment)
                ->select('city')
                ->whereNotNull('city')
                ->where('city', '!=', '')
                ->distinct()
                ->orderBy('city')
                ->get();
        } else {
            // Si no hay departamento, nos aseguramos que la lista de ciudades esté vacía.
            $this->cities = [];
        }
        // --- FIN DE LA LÓGICA CLAVE ---

        $query = BusinessData::with(['business']);

        // ... (Filtros de search, category, storeType se mantienen igual) ...
        $query->when($this->search, fn($q) => $q->whereHas('business', fn($sq) => $sq->where('name', 'like', '%' . $this->search . '%')));
        $query->when($this->selectedCategory, fn($q) => $q->whereHas('business.categories', fn($sq) => $sq->where('business_category_id', $this->selectedCategory)));
        $query->when($this->selectedStoreType, fn($q) => $q->where('store_type', $this->selectedStoreType));

        // Filtros de ubicación
        $query->when($this->selectedCountry, fn($q) => $q->where('country_id', $this->selectedCountry));
        $query->when($this->selectedDepartment, fn($q) => $q->where('department_id', $this->selectedDepartment));

        // Filtro de ciudad robusto (sin cambios, ya era correcto)
        $query->when($this->selectedCity, function ($q) {
            $cityId = City::where('name', $this->selectedCity)->value('id');
            $q->where(function ($subQuery) use ($cityId) {
                $subQuery->where('city', $this->selectedCity)
                    ->when($cityId, fn($ssq) => $ssq->orWhere('city_id', $cityId));
            });
        });

        $businessData = $query->paginate(10);

        return view('livewire.allied-companies', [
            'businessData' => $businessData,
        ]);
    }
}
