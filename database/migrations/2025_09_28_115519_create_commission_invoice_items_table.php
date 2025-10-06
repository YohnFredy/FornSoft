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
        Schema::create('commission_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_received_id')->constrained('commission_receiveds')->onDelete('cascade');
            $table->foreignId('business_data_id')->constrained('business_data'); // Redundancia para facilitar búsquedas
            $table->string('company_name');
            $table->string('invoice_number'); // Número de factura del cliente final reportado por el comercio

            $table->decimal('total_sales_report', 12, 2)->nullable();
            $table->decimal('taxable_amount', 10, 2); // Monto total de la compra del afiliado según el comercio
            $table->decimal('tax_amount', 10, 2); // Monto total de la compra del afiliado según el comercio

            $table->foreignId('invoice_id')->nullable()->constrained('invoices'); // FK a la tabla 'invoices' del afiliado. Será NULL al inicio.
            $table->enum('reconciliation_status', [
                'pending',                   // Pendiente de conciliación
                'matched',                   // Coinciden con invoices
                'unreported_by_fornuvi_member', // Reporte del comercio no existe en invoices
                'unmatched',                 // No concuerdan con invoices
                'manually_matched',          // Ajustado manualmente por admin
                'closed_with_points',            // Cerrado con puntos al miembro
                'closed_with_global_points',     // Cerrado con puntos a la bolsa global cuando no se sabe quien los genero.
            ])->default('pending');

            $table->text('notes')->nullable(); // Notas sobre la conciliación
            $table->timestamps();

            // Índices para búsquedas rápidas durante la conciliación
            $table->index('invoice_number');
            $table->index('reconciliation_status');
            $table->index('business_data_id');

            // Índice único para asegurar que no se dupliquen items de comisión para el mismo comercio y factura
            $table->unique(['business_data_id', 'invoice_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_invoice_items');
    }
};
