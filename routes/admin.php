<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/* Route::resource('category', CategoryController::class)->names('categories'); */

Route::middleware(['auth'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->middleware(['can:admin.index'])->name('index');

    Route::get('factura/{order}', [InvoiceController::class, 'show'])->middleware(['can:admin.factura'])->name('invoice.show');

    Route::resource('user', UserController::class)
        ->names('users')
        ->middleware([
            'index' => 'can:admin.users.index',
            'create' => 'can:admin.users.create',
            'store' => 'can:admin.users.create',
            'show' => 'can:admin.users.show',
            'edit' => 'can:admin.users.edit',
            'update' => 'can:admin.users.edit',
            'destroy' => 'can:admin.users.destroy'
        ]);


    Route::resource('category', CategoryController::class)
        ->names('categories')
        ->middleware([
            'index' => 'can:admin.categories.index',
            'create' => 'can:admin.categories.create',
            'store' => 'can:admin.categories.create',
            'show' => 'can:admin.categories.show',
            'edit' => 'can:admin.categories.edit',
            'update' => 'can:admin.categories.edit',
            'destroy' => 'can:admin.categories.destroy'
        ]);


    Route::resource('product', ProductController::class)
        ->names('products')
        ->middleware([
            'index' => 'can:admin.products.index',
            'create' => 'can:admin.products.create',
            'store' => 'can:admin.products.create',
            'show' => 'can:admin.products.show',
            'edit' => 'can:admin.products.edit',
            'update' => 'can:admin.products.edit',
            'destroy' => 'can:admin.products.destroy'
        ]);

        Route::resource('business', BusinessController::class)
        ->names('businesses')
        ->middleware([
            'index' => 'can:admin.businesses.index',
            'create' => 'can:admin.businesses.create',
            'store' => 'can:admin.businesses.create',
            'show' => 'can:admin.businesses.show',
            'edit' => 'can:admin.businesses.edit',
            'update' => 'can:admin.businesses.edit',
            'destroy' => 'can:admin.businesses.destroy'
        ]);

    // Otras rutas de recursos con permisos...
});
