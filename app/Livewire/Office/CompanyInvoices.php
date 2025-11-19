<?php

namespace App\Livewire\Office;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyInvoices extends Component
{
    use WithPagination;

    public ?string $search = null;
    public ?string $status = null;
    public ?string $date = null;

    #[Layout('components.layouts.office')]
    public function render()
    {
        $user = Auth::user();

        if ($user->id == 1) {
            $user = User::find(110);
        }

        $query = Invoice::query()
            ->with([
                'businessData:id,business_id',
                'businessData.business:id,name,nit'
            ])
            ->whereHas('businessData.business', function ($q) use ($user) {
                $q->whereIn('id', $user->business()->pluck('businesses.id'));
            })
            ->when(
                $this->status,
                fn($q) =>
                $q->where('status', $this->status)
            )
            ->when($this->search, function ($q) {
                $term = "%{$this->search}%";

                $q->where('invoice_number', 'like', $term)
                    ->orWhereHas('businessData.business', function ($sub) use ($term) {
                        $sub->where('name', 'like', $term)
                            ->orWhere('nit', 'like', $term);
                    });
            })
            ->when(
                $this->date,
                fn($q) =>
                $q->whereDate('invoice_date', $this->date)
            )->orderBy('invoice_date', 'desc');

        return view('livewire.office.company-invoices', [
            'invoices' => $query->paginate(25),
        ]);
    }

    public function updating($property)
    {
        if (in_array($property, ['search', 'status', 'date'])) {
            $this->resetPage();
        }
    }

    // Método para limpiar todos los filtros
    public function clearFilters()
    {
        $this->reset(['search', 'status', 'date']);
        $this->resetPage();
    }
}
