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
        Schema::create('commission_receiveds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_data_id')->constrained('business_data'); // O 'businesses' si la renombras
            $table->string('excel_batch_id')->nullable(); // Identificador del archivo Excel o lote de reporte
            $table->date('report_date')->nullable(); // Fecha en que el comercio reporta estas facturas/comisiones

            $table->decimal('total_sales_report', 12, 2)->nullable();
            $table->decimal('taxable_amount', 10, 2); // Monto total de la comisión recibida de Fornuvi por el comercio
            $table->decimal('tax_amount', 10, 2)->nullable(); // Monto de IVA asociado a la comisión (si Fornuvi factura con IVA)
            $table->date('payment_date')->nullable(); // Fecha real del pago recibido
            $table->string('payment_reference')->nullable(); // Referencia del pago (ej. número de transferencia)
            $table->string('fornuvi_invoice_number')->nullable(); // Número de factura que Fornuvi emite al comercio

            $table->enum('commission_status', [
                'pending',          // Pendiente
                'reported_unpaid',  // Info recibida, dinero no recibido
                'reported_paid',    // Info recibida y dinero recibido
                'mismatch_unpaid',  // Info recibida, dinero no recibido, datos inconsistentes
                'mismatch_paid',    // Info recibida, dinero recibido, datos inconsistentes
                'certified',        // Validado y cerrado correctamente
            ])->default('pending');

            $table->timestamps();

            $table->index('business_data_id');
            $table->index('report_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_receiveds');
    }
};
