<?php

namespace App\Livewire\Admin\AlliedCommissions;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SupportInvoice extends Component
{

     #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.allied-commissions.support-invoice');
    }
}
