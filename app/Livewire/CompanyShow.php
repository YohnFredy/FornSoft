<?php

namespace App\Livewire;

use App\Models\BusinessData;
use Livewire\Component;

class CompanyShow extends Component
{
    public $businessData;

    public function mount($id)
{
    $this->businessData = BusinessData::with([
        'business.images' => function ($query) {
            $query->where('type', 'image');
        },
        'country',
        'department',
        'cityRelation'
    ])->findOrFail($id);
}

    public function render()
    {
        return view('livewire.company-show');
    }
}
