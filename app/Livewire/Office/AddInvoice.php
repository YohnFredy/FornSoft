<?php

namespace App\Livewire\Office;

use App\Models\Business;
use App\Models\BusinessData;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image as InterventionImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddInvoice extends Component
{

    use WithFileUploads;

    public $search = '';
    public $matchingMerchants;
    public $selectedMerchant = null;
    public $merchantCities;
    public $selectedCity = '';
    public $merchantBranches;
    public $selectedBranchId = '';
    public $company_name = '';
    public $nit = '';

    public $invoice_number;
    public $total_amount;
    public $invoice_date;

    public $recaptcha_token = '';

    public $image;

    protected $rules = [
        'selectedMerchant' => 'required|exists:businesses,id',
        'selectedCity' => 'required|string',
        'selectedBranchId' => 'required|exists:business_data,id',
        'invoice_number' => 'required|string|max:255',
        'total_amount' => 'required|numeric|min:0',
        'invoice_date' => 'required|date',
        'image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB Max
    ];

    public function mount()
    {
        $this->matchingMerchants = collect();
        $this->merchantCities = collect();
        $this->merchantBranches = collect();
    }

    public function updatedSearch()
    {
        $this->resetSelection();
        if (strlen($this->search) < 2) {
            $this->matchingMerchants = collect();
            return;
        }
        $this->matchingMerchants = Business::where('nit', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function selectMerchant($merchantId)
    {
        $this->selectedMerchant = $merchantId;
        $merchant = Business::find($merchantId);
        if (!$merchant) {
            $this->resetSelection();
            return;
        }

        $this->company_name = $merchant->name;
        $this->nit =  $merchant->nit ?: $this->company_name;
        $this->search = "{$merchant->name} ({$merchant->nit})";
        $branches = BusinessData::where('business_id', $merchantId)->get();
        $this->merchantCities = $branches->pluck('city')->unique()->values();
        if ($this->merchantCities->isNotEmpty()) {
            $this->selectedCity = $this->merchantCities->first();
            $this->updateBranches();
        } else {
            $this->selectedCity = '';
            $this->merchantBranches = collect();
            $this->selectedBranchId = '';
        }
        $this->matchingMerchants = collect();
    }

    public function updatedSelectedCity()
    {
        $this->updateBranches();
    }

    public function updateBranches()
    {

        if (!$this->selectedMerchant || !$this->selectedCity) {
            $this->merchantBranches = collect();
            $this->selectedBranchId = '';
            return;
        }
        $branches = BusinessData::where('business_id', $this->selectedMerchant)
            ->where('city', $this->selectedCity)
            ->get();
        $this->merchantBranches = $branches;
        if ($branches->isNotEmpty()) {
            $this->selectedBranchId = $branches->first()->id;
        } else {
            $this->selectedBranchId = '';
        }
    }

    public function resetSelection()
    {
        $this->selectedMerchant = null;
        $this->company_name = '';
        $this->nit = '';
        $this->selectedCity = '';
        $this->selectedBranchId = '';
        $this->merchantCities = collect();
        $this->merchantBranches = collect();
    }

    public function resetForm()
    {
        $this->reset([
            'search',
            'company_name',
            'nit',
            'image',
            'invoice_number',
            'total_amount',
            'invoice_date',
        ]);
        $this->resetSelection();
        $this->matchingMerchants = collect();
    }

    public function save()
    {
        $this->validate();

        // Validar combinación única de nit + invoice_number
        $exists = \App\Models\Invoice::where('invoice_number', $this->invoice_number)
            ->where('nit', $this->nit)
            ->exists();

        if ($exists) {
            session()->flash('error', '⚠️ Ya existe una factura con este número y este NIT.');
            return;
        }
        $branch = BusinessData::find($this->selectedBranchId);
        if (
            !$branch ||
            $branch->business_id != $this->selectedMerchant ||
            $branch->city != $this->selectedCity
        ) {
            $this->addError('selectedBranchId', 'La ciudad y sucursal no coinciden con el comercio seleccionado.');
            return;
        }

        $uploadedFile = $this->image;
        $originalExtension = $uploadedFile->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $originalExtension;
        $directory = 'invoices/' . now()->format('Y/m/d');
        $storagePath = $directory . '/' . $filename;

        if (str_starts_with($uploadedFile->getMimeType(), 'image/')) {
            $imageManager = InterventionImage::read($uploadedFile->getRealPath())
                ->scale(width: 720);
            $encodedImage = $imageManager->toWebp(60);
            Storage::disk('public')->put($storagePath, (string) $encodedImage);
        } else {
            $uploadedFile->storeAs($directory, $filename, 'public');
        }

        Invoice::create([
            'user_id' => Auth::id(),
            'business_data_id' => $this->selectedBranchId,
            'company_name' => $this->company_name,
            'nit' => $this->nit,
            'invoice_number' => $this->invoice_number,
            'total_amount' => $this->total_amount,
            'invoice_date' => $this->invoice_date,
            'image_path' => $storagePath,
            'status' => 'pending_review',
        ]);

        session()->flash('message', 'Factura cargada exitosamente.');
        $this->resetForm();
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        return view('livewire.office.add-invoice', [
            'cities' => $this->merchantCities,
        ]);
    }
}
