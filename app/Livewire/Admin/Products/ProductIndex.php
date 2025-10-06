<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '', $searchTerms;

    public function searchEnter()
    {
        if (empty(trim($this->search))) {
            $this->clearSearch();
        } else {
            $this->searchTerms = array_filter(explode(' ', $this->search));
            $this->resetPage();
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchTerms = [];
        $this->resetPage();
    }

    public function destroy($id)
    {
        $this->authorize('admin.products.destroy');

        $brand = Product::findOrFail($id);
        $brand->delete();

        // Opcional: mandar un mensaje flash
        session()->flash('success', 'El producto fue eliminada correctamente.');
    }

     #[Layout('components.layouts.admin')]
    public function render()
    {
        $this->authorize('admin.products.index');

        $products = Product::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $products->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            }
        }

        $products = $products->orderBy('id', 'desc')->paginate(5);

        return view('livewire.admin.products.product-index', [
            'products' => $products
        ]);
    }
}
