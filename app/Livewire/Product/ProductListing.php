<?php

namespace App\Livewire\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    public $search = '';
    public $category = null;
    public $selectedBrand = null;
    public $priceMin = null;
    public $priceMax = null;
    public $sortBy = '';
    public $isPhysical = 'all';
    public $inStock = 'all';
    public $perPage = 12;
    public $filter = false;

    public $showDropdown = false;



    #[On('showCategory')]
    public function showCategory($id)
    {
        $this->clearFilters();
        $this->filter = true;
        $this->showDropdown = false;
        $this->category = $id;
        $this->resetPage();
    }

    public function updatedSearch($value)
    {
        $this->clearFilters();
        $this->filter = true;
        $this->search = $value;
    }

    // Limpiar filtros
    public function clearFilters()
    {
        $this->reset([
            'search',
            'category',
            'selectedBrand',
            'priceMin',
            'priceMax',
            'sortBy',
            'isPhysical',
            'inStock',
            'filter'
        ]);
        $this->resetPage();
    }


    #[Layout('components.layouts.app')]
    public function render()
    {
        // Base de la consulta
        $productsQuery = Product::where('is_active', true);

        $brands = Brand::where('is_active', true)->orderBy('name')->get();

        // Filtrado
        if ($this->search) {
            $productsQuery->where(
                fn($query) =>
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
            );
        }

        if ($this->category) {
            $productsQuery->where('category_id', $this->category);
        }

        if ($this->selectedBrand) {
            $productsQuery->where('brand_id', $this->selectedBrand);
        }

        if ($this->priceMin) {
            $productsQuery->where('final_price', '>=', $this->priceMin);
        }

        if ($this->priceMax) {
            $productsQuery->where('final_price', '<=', $this->priceMax);
        }

        // Filtro de tipo de producto (físico/digital)
        if ($this->isPhysical !== 'all') {
            $productsQuery->where('is_physical', (bool) $this->isPhysical);
        }

        // Filtro de disponibilidad
        if ($this->inStock !== 'all') {
            if ($this->inStock == '1') {
                $productsQuery->where(
                    fn($query) =>
                    $query->where('stock', '>', 0)
                        ->orWhere('allow_backorder', true)
                );
            } elseif ($this->inStock == '0') {
                $productsQuery->where('stock', 0)->where('allow_backorder', false);
            }
        }

        // Ordenamiento
        $sortOptions = [
            'price_asc' => ['final_price', 'asc'],
            'price_desc' => ['final_price', 'desc'],
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'newest' => ['created_at', 'desc']
        ];

        $sortColumn = $sortOptions[$this->sortBy] ?? ['pts_base', 'desc'];
        $productsQuery->orderBy(...$sortColumn);

        // Paginación
        $products = $productsQuery->paginate($this->perPage);

        return view('livewire.product.product-listing', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }
}
