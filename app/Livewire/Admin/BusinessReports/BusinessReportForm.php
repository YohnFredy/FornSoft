<?php

namespace App\Livewire\Admin\BusinessReports;

use App\Models\Business;
use App\Models\BusinessReport;
use App\Models\BusinessData;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

class BusinessReportForm extends Component
{
    public ?BusinessReport $businessReport;

    // Campos del formulario
    public $invoice_date;
    public $business_data_id;
    public $user_dni;
    public $total_amount;
    public $commission;
    public $currency = 'COP';
    public $status = 'pending_review';
    public $invoice_number;
    public $businesses;

    public $isEditMode = false;

    public function mount(BusinessReport $businessReport)
    {
        $this->businessReport = $businessReport;

        $this->businesses = BusinessData::all();

        // Modo edición
        if ($businessReport->exists) {
            $this->authorize('admin.businessReports.edit');

            $this->isEditMode = true;

            // Cargar datos del modelo
            $this->fill($businessReport->only([
                'invoice_date',
                'business_data_id',
                'user_dni',
                'total_amount',
                'commission',
                'currency',
                'status',
                'invoice_number',
            ]));
        }
        // Modo creación
        else {
            $this->authorize('admin.businessReports.create');
        }
    }

    public function rules()
    {
        return [
            'invoice_date'      => ['nullable', 'date'],
            'business_data_id'  => ['required', 'numeric'],
            'user_dni'          => ['nullable', 'string', 'max:255'],
            'total_amount'      => ['nullable', 'numeric'],
            'commission'        => ['nullable', 'numeric'],
            'currency'          => ['nullable', 'string', 'max:10'],
            'status'            => ['required', Rule::in(['pending_review', 'approved', 'rejected'])],

            // unique(invoice_number + business_data_id)
            'invoice_number' => [
                'nullable',
                Rule::unique('business_reports')
                    ->where('business_data_id', $this->business_data_id)
                    ->ignore($this->businessReport?->id),
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        // Crear nuevo
        $report = BusinessReport::create($this->formData());
        $invoice = Invoice::where('business_data_id', $report->business_data_id)->where('invoice_number', $report->invoice_number)
            ->first();

        if (!$invoice) {
            $user = User::where('dni',  $report->user_dni)->first();

            $business = Business::find($report->business_data_id);

            if ($user) {
                Invoice::create([
                    'user_id' => $user->id,
                    'business_data_id' => $report->business_data_id,
                    'company_name' => $business->name,
                    'nit' => $business->nit,
                    'invoice_number' => $report->invoice_number,
                    'total_amount' => $report->total_amount,
                    'invoice_date' => $report->invoice_date,
                    'currency' => $report->currency,
                    'image_path' => 'images/factura-en-blanco.jpg',
                ]);
            } else {
                $business = Business::find($report->business_data_id);
                Invoice::create([
                    'user_id' => 1,
                    'business_data_id' => $report->business_data_id,
                    'company_name' => $business->name,
                    'nit' => $business->nit,
                    'invoice_number' => $report->invoice_number,
                    'total_amount' => $report->total_amount,
                    'invoice_date' => $report->invoice_date,
                    'currency' => $report->currency,
                    'image_path' => 'images/factura-en-blanco.jpg',
                ]);
            }
        }

        session()->flash('success', 'Reporte creado exitosamente.');

        return redirect()->route('admin.businessReports.index');
    }

    public function update()
    {
        $this->validate();

        // Actualizar existente
        $this->businessReport->update($this->formData());

        session()->flash('success', 'El reporte fue actualizado correctamente.');

        return redirect()->route('admin.businessReports.index');
    }

    private function formData()
    {
        return [
            'invoice_date'     => $this->invoice_date,
            'business_data_id' => $this->business_data_id,
            'user_dni'         => $this->user_dni,
            'total_amount'     => $this->total_amount,
            'commission'       => $this->commission,
            'currency'         => $this->currency,
            'status'           => $this->status,
            'invoice_number'   => $this->invoice_number,
        ];
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.business-reports.business-report-form');
    }
}
