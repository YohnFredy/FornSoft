<?php

namespace App\Livewire;

use App\Models\BusinessData;
use Livewire\Component;

class CompanyShow extends Component
{
    public BusinessData $businessData;

    public function mount(BusinessData $businessData)
    {
        // Cargar relaciones necesarias
        $this->businessData = $businessData->load([
            'business.images' => function ($query) {
                $query->where('type', 'image');
            },
            'country',
            'department',
            'cityRelation'
        ]);
    }

    public function render()
    {
        return view('livewire.company-show');
    }
}
