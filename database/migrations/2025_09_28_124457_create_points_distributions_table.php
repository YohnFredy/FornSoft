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
        Schema::create('points_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
            $table->foreignId('invoice_id')->nullable()->constrained('invoices'); // Si los puntos vienen de una factura de afiliado específica
            $table->foreignId('commission_invoice_item_id')->nullable()->constrained('commission_invoice_items'); // Si los puntos vienen de un item de comisión conciliado
            $table->decimal('points', 10, 2)->default(0); // Cantidad de puntos asignados
           
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_distributions');
    }
};
