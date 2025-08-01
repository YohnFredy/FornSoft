<?php


use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookBoldController;
use App\Http\Controllers\WebhookController;
use App\Livewire\AlliedCompanies;
use App\Livewire\CompanyShow;
use App\Livewire\Order\OrderCreate;
use App\Livewire\Product\Cart;
use App\Livewire\Product\ProductListing;
use App\Livewire\Product\ProductShow;
use App\Livewire\Prueba;
use App\Livewire\ShowProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index');
})->name('home');

// Ruta principal para la landing page
Route::get('/landing', [LandingPageController::class, 'show'])->name('landing.show');
Route::get('/oportunidad-de-negocio', [LandingPageController::class, 'show2'])->name('landing.show2');

// Ruta para recibir los datos de seguimiento (eventos) vía AJAX
Route::post('/track-event', [LandingPageController::class, 'trackEvent'])->name('landing.track');

Route::get('/productos', ProductListing::class)->name('products.index');
Route::get('producto/{product}', ProductShow::class)->name('products.show');


Route::post('/contacto', [ContactController::class, 'store'])->name('contacto.store');

Route::get('empresas-aliadas', AlliedCompanies::class)->name('companies.index');
Route::get('empresa-aliada/{id}', CompanyShow::class)->name('companies.show');

Route::get('prueba', Prueba::class)->name('prueba');


/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('carrito', Cart::class)->name('products.cart');
    Route::get('order/create', OrderCreate::class)->name('orders.create');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}/show', [OrderController::class, 'show'])->name('orders.show');



    //Pasarela de pagos Bold
    Route::get('/checkout/bold/{order}', [OrderController::class, 'boldCheckout'])->name('bold.checkout');
    Route::get('/pagos/respuesta/bold', [PaymentController::class, 'BoldResponse'])->name('bold.response');

    //pasarela de pagos Wompi
    Route::get('/checkout/wompi/{order}', [OrderController::class, 'wompiCheckout'])->name('wompi.checkout');
    Route::get('/pagos/respuesta', [PaymentController::class, 'wompiResponse'])->name('wompi.response');
});

Route::post('/webhook/bold', [WebhookBoldController::class, 'handleBoldWebhook']);
Route::post('/webhook/wompi', [WebhookController::class, 'handleWompiWebhook']);

require __DIR__ . '/auth.php';
