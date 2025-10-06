<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('public_order_number')->unique(); // Número de orden público (no secuencial real)
            $table->foreignId('user_id')->constrained()->restrictOnDelete(); // Cliente que hizo la compra
            $table->tinyInteger('status')->default(1)->unsigned(); // Estado de la orden (ej. 1=pending, 2=paid, etc.)
            $table->string('payment_method')->nullable(); // Método de pago (tarjeta, PSE, etc.)
            $table->unsignedTinyInteger('shipping_type')->default(1)->comment('1 = Store, 2 = delivery'); // Tipo de entrega

            // DATOS del que recibe
            $table->string('shipping_name')->nullable(); // Nombre completo / Razón social
            $table->foreignId('document_type_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('shipping_document')->nullable(); // Número de documento
            $table->string('shipping_phone')->nullable();

            $table->decimal('subtotal', 10, 2)->default(0); // La suma del precio de los productos (sin ajustes).
            $table->decimal('discount', 10, 2)->default(0); // Descuentos aplicados
            $table->decimal('taxable_amount', 10, 2)->default(0); // La base sobre la que se calculó el impuesto.
            $table->decimal('tax_amount', 10, 2)->default(0); // Total de IVA
            $table->decimal('shipping_cost', 10, 2)->default(0); // Costo de envíoyy
            $table->decimal('total', 10, 2)->default(0)->check('total >= 0'); // Total pagado = subtotal - descuento + impuesto + envío
            $table->decimal('total_pts', 10, 2)->default(0)->check('total_pts >= 0'); // Puntos generados por la orden

            //datos de entrega
            $table->foreignId('shipping_country_id')->nullable()->constrained('countries')->cascadeOnUpdate();
            $table->foreignId('shipping_department_id')->nullable()->constrained('departments')->cascadeOnUpdate();
            $table->foreignId('shipping_city_id')->nullable()->constrained('cities')->cascadeOnUpdate();
            $table->string('shipping_addCity')->nullable(); // Para agregar ciudad manual si no aparece
            $table->text('shipping_address')->nullable();
            $table->string('shipping_additional_address')->nullable(); // Detalles adicionales de dirección

            $table->timestamps();

            $table->index('public_order_number');
            $table->index('status');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
