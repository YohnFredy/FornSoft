<?php

namespace App\Livewire\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceShow extends Component
{

    use WithPagination; // Usar el trait de paginación

    #[Layout('components.layouts.office')]
    public function render()
    {
        $user = Auth::user();
        if ($user->id == 1) {
            $user = User::find(111);
        }

        $invoices = $user->invoices()
            ->with('businessData.business')
            ->latest()
            ->paginate(10);

        return view('livewire.office.invoice-show', [
            'invoices' => $invoices,
        ]);
    }
}
