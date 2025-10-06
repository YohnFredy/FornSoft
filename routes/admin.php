<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\RoleController;
use App\Livewire\Admin\AlliedCommissions\SupportInvoice;
use App\Livewire\Admin\Businesses\BusinessForm;
use App\Livewire\Admin\Businesses\BusinessIndex;
use App\Livewire\Admin\Categories\CategoryForm;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Orders\OrdersManagement;
use App\Livewire\Admin\Products\ProductForm;
use App\Livewire\Admin\Products\ProductIndex;
use App\Livewire\Admin\Users\UserForm;
use App\Livewire\Admin\Users\UserIndex;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->middleware(['can:admin.index'])->name('index');
    Route::get('order', OrdersManagement::class)->name('orders.management');

    Route::get('soporte/factura', SupportInvoice::class)->name('SupportInvoice');

    Route::get('factura/{order}', [InvoiceController::class, 'show'])->middleware(['can:admin.factura'])->name('invoice.show');

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
});
