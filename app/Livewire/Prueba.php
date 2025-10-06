<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\CommissionReceived;
use App\Models\Invoice;
use GuzzleHttp\Promise\Create;
use Livewire\Attributes\Layout;
use Livewire\Component;

use function Pest\Laravel\get;

class Prueba extends Component
{

    public $business_data_id  = 2, $report_date = '2025-08-26', $payment_date = "2025-08-26", $taxable_amount = 20168.07, $tax_amount = 3831.93, $status = 'reconciled';

    public function commission_Received()
    {
        CommissionReceived::create([
            'business_data_id' => $this->business_data_id,
            'report_date' => $this->report_date,
            'payment_date' => $this->payment_date,
            'taxable_amount' => $this->taxable_amount,
            'tax_amount' => $this->tax_amount,
            'status' => $this->status,
            
        ]);
    }


    public function mount() {}



    public function render()
    {
        return view('livewire.prueba');
    }
}
