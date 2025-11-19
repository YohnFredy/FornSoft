<?php

use App\Http\Controllers\Office\InvoiceController;
use App\Livewire\Office\AddInvoice;
use App\Livewire\Office\BinaryTree;
use App\Livewire\Office\Commissions;
use App\Livewire\Office\CompanyInvoices;
use App\Livewire\Office\Dashboard;
use App\Livewire\Office\InvoiceShow;
use App\Livewire\Office\MyCompanies;
use App\Livewire\Office\UnilevelTree;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('comisiones', Commissions::class)->name('commissions');
Route::get('binary/tree', BinaryTree::class)->name('binary-tree');
Route::get('unilevel/tree', UnilevelTree::class)->name('unilevel-tree');

Route::get('agregar-factura', AddInvoice::class)->name('add-invoice');
Route::get('soporte-factura', InvoiceShow::class)->name('invoice.show');
Route::get('mis-empresas', MyCompanies::class)->name('my-companies');
Route::get('mis-empresas_facturas', CompanyInvoices::class)->name('company.invoices');


