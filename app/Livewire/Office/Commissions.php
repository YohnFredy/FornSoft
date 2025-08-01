<?php

namespace App\Livewire\Office;

use App\Models\Commission;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Commissions extends Component
{
    use WithPagination;

    public $user;
    public $summaryCommission; // Resumen de comisiones (ej. totales)
    public $selectedPeriod = 'last_month';
    public $selectedType = '1';

    #[Layout('components.layouts.office')]
    public function render()
    {
        $this->user = Auth::user();

        // Obtiene resumen total (puedes personalizarlo según lógica real)
        $this->summaryCommission = Commission::where('user_id', $this->user->id)->sum('commission');

        // Obtiene lista paginada de comisiones
        $commissions = Commission::where('user_id', $this->user->id)
            ->when($this->selectedType, fn($query) => $query->where('type', $this->selectedType))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.office.commissions', [
            'commissions' => $commissions
        ]);
    }
}
