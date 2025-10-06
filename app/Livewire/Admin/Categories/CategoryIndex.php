<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;

class CategoryIndex extends Component
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
        $this->authorize('admin.categories.destroy');

        $category = Category::findOrFail($id);
        $category->delete();

        // Opcional: mandar un mensaje flash
        session()->flash('success', 'La categoria fue eliminada correctamente.');
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        $categories = Category::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $categories->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%');
                });
            }
        }
        $categories = $categories->orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.categories.category-index', [
            'categories' => $categories
        ]);
    }
}
