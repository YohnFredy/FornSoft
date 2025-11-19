<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Livewire\Admin\Businesses\BusinessForm;
use App\Livewire\Admin\Businesses\BusinessIndex;
use App\Livewire\Admin\BusinessReports\BusinessReportForm;
use App\Livewire\Admin\BusinessReports\BusinessReportIndex;
use App\Livewire\Admin\Categories\CategoryForm;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Commissions\Bag;
use App\Livewire\Admin\Invoices\InvoiceForm;
use App\Livewire\Admin\Invoices\InvoiceIndex;
use App\Livewire\Admin\Orders\OrdersManagement;
use App\Livewire\Admin\Products\ProductForm;
use App\Livewire\Admin\Products\ProductIndex;
use App\Livewire\Admin\PubManager;
use App\Livewire\Admin\SendWhatsapp;
use App\Livewire\Admin\Users\UserForm;
use App\Livewire\Admin\Users\UserIndex;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->middleware(['can:admin.index'])->name('index');
    Route::get('order', OrdersManagement::class)->name('orders.management');

    Route::resource('role', RoleController::class)
        ->names('roles')
        ->middlewareFor('index', 'can:admin.roles.index')
        ->middlewareFor(['create', 'store'], 'can:admin.roles.create')
        ->middlewareFor('show', 'can:admin.roles.show')
        ->middlewareFor(['edit', 'update'], 'can:admin.roles.edit')
        ->middlewareFor('destroy', 'can:admin.roles.destroy');

    Route::get('category', CategoryIndex::class)->name('categories.index');
    Route::get('category/create', CategoryForm::class)->name('categories.create');
    Route::get('category/{category}/edit', CategoryForm::class)->name('categories.edit');

    Route::resource('brands', BrandController::class)
        ->names('brands')
        ->middlewareFor('index', 'can:admin.brands.index')
        ->middlewareFor(['create', 'store'], 'can:admin.brands.create')
        ->middlewareFor('show', 'can:admin.brands.show')
        ->middlewareFor(['edit', 'update'], 'can:admin.brands.edit')
        ->middlewareFor('destroy', 'can:admin.brands.destroy');

    Route::get('user', UserIndex::class)->name('users.index');
    Route::get('user/create', UserForm::class)->name('users.create');
    Route::get('user/{user}/edit', UserForm::class)->name('users.edit');


    Route::get('Product', ProductIndex::class)->name('products.index');
    Route::get('product/create', ProductForm::class)->name('products.create');
    Route::get('product/{product}/edit', ProductForm::class)->name('products.edit');

    Route::get('business', BusinessIndex::class)->name('businesses.index');
    Route::get('business/create', BusinessForm::class)->name('businesses.create');
    Route::get('business/{businessData}/edit', BusinessForm::class)->name('businesses.edit');


    Route::get('gestor-publicidad', PubManager::class)->name('pubMangers.index');
    Route::get('gestor-publicidad/create', PubManager::class)->name('pubMangers.create');
    Route::get('gestor-publicidad/{product}/edit', PubManager::class)->name('pubMangers.edit');

    Route::get('soporte_de_compras_usuarios', InvoiceIndex::class)->name('invoices.index');
    Route::get('soporte_de_compras_usuarios/create', InvoiceForm::class)->name('invoices.create');
    Route::get('soporte_de_compras_usuarios/{invoice}/edit', InvoiceForm::class)->name('invoices.edit');

    Route::get('soporte_de_compras_negocio', BusinessReportIndex::class)->name('businessReports.index');
    Route::get('soporte_de_compras_negocio/create', BusinessReportForm::class)->name('businessReports.create');
    Route::get('soporte_de_compras_negocio/{businessReport}/edit', BusinessReportForm::class)->name('businessReports.edit');


    Route::get('Bolsaglobal', Bag::class)->name('bag');

    Route::get('send/WhatsApp', SendWhatsapp::class)->name('sendWhatsApp.index');
});
