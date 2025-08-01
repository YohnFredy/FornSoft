<?php

namespace App\Livewire;

use App\Models\BusinessCategory;
use App\Models\BusinessData;
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
        $this->categories = BusinessCategory::all();
        $this->countries = Country::all();
        $this->storeTypes = [
            'physical' => 'Tienda Física',
            'online' => 'Tienda en Línea',
            'hybrid' => 'Híbrida (Física y en Línea)',
        ];
    }

    // MODIFICADO: Se añade 'search' al array para resetear la paginación al buscar
    public function updating($property)
    {
        if (in_array($property, ['selectedCategory', 'selectedCountry', 'selectedDepartment', 'selectedCity', 'selectedStoreType', 'search'])) {
            $this->resetPage();
        }
    }

    public function updatedSelectedCountry($value)
    {
        $this->reset(['selectedDepartment', 'selectedCity', 'departments', 'cities']);
        if (!empty($value)) {
            $this->departments = Department::where('country_id', $value)->get();
        }
    }

    public function updatedSelectedDepartment($value)
    {
        $this->reset(['selectedCity', 'cities']);
        if (!empty($value)) {
            $this->loadCities();
        }
    }

    public function loadCities()
    {
        if (empty($this->selectedDepartment)) {
            $this->cities = [];
            return;
        }
        $department = Department::find($this->selectedDepartment);
        if (!$department) return;
        
        $countryName = Country::find($this->selectedCountry)->name ?? '';
        
        $query = BusinessData::query()
            ->select('city')->distinct()->whereNotNull('city')->where('city', '!=', '')
            ->where('department', $department->name)->where('country', $countryName)->orderBy('city');
        
        $query->when($this->selectedCategory, function ($q) {
            $q->whereHas('business.categories', function ($subQ) {
                $subQ->where('business_category_id', $this->selectedCategory);
            });
        });
        
        $this->cities = $query->get()->map(fn($item) => (object) ['city' => $item->city]);
    }

    // MODIFICADO: Se añade 'search' para que el botón de limpiar también lo borre
    public function clearFilters()
    {
        $this->reset([
            'selectedCategory', 'selectedCountry', 'selectedDepartment',
            'selectedCity', 'selectedStoreType', 'departments', 'cities', 'search'
        ]);
        $this->resetPage();
    }

    public function render()
    {
        $query = BusinessData::with(['business']);

        // AÑADIDO: Lógica del filtro de búsqueda por nombre
        // Se usa whereHas para filtrar en la tabla relacionada 'business'
        $query->when($this->search, function ($q) {
            $q->whereHas('business', function ($subQ) {
                // Busca coincidencias parciales en el nombre del negocio
                $subQ->where('name', 'like', '%' . $this->search . '%');
            });
        });

        // Filtros existentes
        $query->when($this->selectedCategory, function ($q) {
            $q->whereHas('business.categories', function ($subQ) {
                $subQ->where('business_category_id', $this->selectedCategory);
            });
        });
        $query->when($this->selectedStoreType, fn($q) => $q->where('store_type', $this->selectedStoreType));
        $query->when($this->selectedCountry, function ($q) {
            $country = Country::find($this->selectedCountry);
            if ($country) $q->where('country', $country->name);
        });
        $query->when($this->selectedDepartment, function ($q) {
            $department = Department::find($this->selectedDepartment);
            if ($department) $q->where('department', $department->name);
        });
        $query->when($this->selectedCity, fn($q) => $q->where('city', $this->selectedCity));

        $businessData = $query->paginate(5);

        return view('livewire.allied-companies', [
            'businessData' => $businessData,
        ]);
    }
}