<?php

namespace App\Livewire\Admin\Businesses;

use App\Models\Business;
use App\Models\BusinessData;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BusinessIndex extends Component
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
        $this->authorize('admin.businesses.destroy');

        $brand = Business::findOrFail($id);
        $brand->delete();
        
        session()->flash('success', 'El producto fue eliminada correctamente.');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $this->authorize('admin.businesses.index');
        
        $businessData = BusinessData::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $businessData->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('nit', 'like', '%' . $term . '%');
                });
            }
        }

        $businessData  = $businessData->orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.businesses.business-index', [
            'businessData' => $businessData
        ]);
    }
}
