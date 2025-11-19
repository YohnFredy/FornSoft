<?php

namespace App\Livewire\Office;

use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyCompanies extends Component
{
    public $user;
    public ?Business $selectedBusiness = null;
    public bool $showModal = false;

    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->id == 1) {
            $this->user = User::find(110);
        }
    }


    public function showBusinessData(int $businessId)
    {
        $this->selectedBusiness = Business::with('data')->find($businessId);
        $this->showModal = true;
        $this->dispatch('$refresh');
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        return view('livewire.office.my-companies');
    }
}
