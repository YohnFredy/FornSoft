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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate(); // Relación con la orden
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate(); // Producto relacionado

            $table->string('name'); // Nombre del producto al momento de la compra (por si cambia luego)

            $table->decimal('unit_price', 10, 2); //Precio con iva
            $table->decimal('pts', 10, 2)->default(0);
            $table->unsignedInteger('quantity');
            $table->decimal('discount', 10, 2)->default(0); //Descuento total
            $table->decimal('tax_percent', 5, 2)->default(0); //Porcentaje de impuesto aplicado (ej. 19%)
            $table->decimal('tax_amount', 10, 2)->default(0); // Valor del IVA total en este item
            $table->decimal('unit_sales_price', 10, 2);
            $table->decimal('totalPts', 10, 2)->default(0);
            $table->timestamps();

            $table->index('order_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
