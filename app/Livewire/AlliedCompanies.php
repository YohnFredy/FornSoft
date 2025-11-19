<?php

namespace App\Livewire;

use App\Models\BusinessCategory;
use App\Models\BusinessData;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\StoreType;
use Livewire\Component;
use Livewire\WithPagination;

class AlliedCompanies extends Component
{
    use WithPagination;

    // Propiedades para filtros
    public $search = '';
    public $selectedCategory = '';
    public $selectedCountry = '';
    public $selectedDepartment = '';
    public $selectedCity = '';
    public $selectedStoreType = ''; // Este ahora almacenará el ID del tipo de tienda

    // Colecciones para los selects
    public $categories = [];
    public $countries = [];
    public $departments = [];
    public $cities = [];
    public $storeTypes = []; // Este ahora será una colección de modelos StoreType


    public function mount()
    {
        // Cargar datos iniciales para los filtros
        $this->categories = BusinessCategory::orderBy('name')->get();
        $this->countries = Country::orderBy('name')->get();

        // 2. Cargar los tipos de tienda desde la base de datos
        $this->storeTypes = StoreType::orderBy('name')->get();

        // Inicializar arrays vacíos
        $this->departments = collect(); // Es buena práctica inicializar como colección vacía
        $this->cities = collect();
    }

    // Se ejecuta cuando cualquier propiedad pública se está actualizando
    public function updating($property)
    {
        // Si cambia alguno de los filtros, resetea la paginación
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
            'search',
            'selectedCategory',
            'selectedCountry',
            'selectedDepartment',
            'selectedCity',
            'selectedStoreType',
        ]);

        // Resetea las colecciones dependientes
        $this->departments = collect();
        $this->cities = collect();
        $this->resetPage();
    }


    public function render()
    {
        // Cargar ciudades si hay un departamento seleccionado
        if ($this->selectedDepartment) {
            $this->cities = BusinessData::query()
                ->where('department_id', $this->selectedDepartment)
                ->select('city')
                ->whereNotNull('city')
                ->where('city', '!=', '')
                ->distinct()
                ->orderBy('city')
                ->get();
        } else {
            $this->cities = collect();
        }

        // Iniciar la consulta base
        $query = BusinessData::with(['business.latestLogo', 'storeTypes'])->where('is_active', 1); // Precargar relaciones necesarias

        // Aplicar filtro de búsqueda por nombre de empresa
        $query->when($this->search, function ($q) {
            $q->whereHas('business', function ($sq) {
                $sq->where('name', 'like', '%' . $this->search . '%');
            });
        });

        // Aplicar filtro por categoría de negocio
        $query->when($this->selectedCategory, function ($q) {
            $q->whereHas('business.categories', function ($sq) {
                $sq->where('business_category_id', $this->selectedCategory);
            });
        });

        // 3. ¡CAMBIO CLAVE! Filtrar por tipo de tienda usando la relación many-to-many
        $query->when($this->selectedStoreType, function ($q) {
            $q->whereHas('storeTypes', function ($sq) {
                $sq->where('store_type_id', $this->selectedStoreType);
            });
        });

        // Aplicar filtros de ubicación
        $query->when($this->selectedCountry, fn($q) => $q->where('country_id', $this->selectedCountry));
        $query->when($this->selectedDepartment, fn($q) => $q->where('department_id', $this->selectedDepartment));

        // Aplicar filtro por nombre de ciudad
        $query->when($this->selectedCity, fn($q) => $q->where('city', $this->selectedCity));

        // Paginación
        $businessData = $query->paginate(10);

        return view('livewire.allied-companies', [
            'businessData' => $businessData,
        ]);
    }
}
