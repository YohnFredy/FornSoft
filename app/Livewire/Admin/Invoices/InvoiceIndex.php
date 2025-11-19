<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InvoiceIndex extends Component
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
        $this->authorize('admin.invoices.destroy');

        $invoice = Invoice::findOrFail($id);

        // Eliminar imagen si existe
        if ($invoice->image_path && Storage::disk('public')->exists($invoice->image_path)) {
            Storage::disk('public')->delete($invoice->image_path);
        }

        // Eliminar el registro
        $invoice->delete();

        session()->flash('success', 'El soporte fue eliminado correctamente.');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
         $this->authorize('admin.invoices.index');

        return view('livewire.admin.invoices.invoice-index', [
            'invoices' => Invoice::orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
