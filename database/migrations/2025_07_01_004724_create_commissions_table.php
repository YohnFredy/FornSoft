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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->foreignId('user_id')->constrained()->onDelete('restrict');

            // Tipo de comisión: enum
            $table->enum('type', [
                '1', // Bolsa Global
                '3', // Generacional
                '4', // Gen Avanzado
                '5', // Rangos
                '6', // Regalias
            ]);

            // Valor base de facturación (VFB)
            $table->decimal('vfb', 5, 2)->default(0);

            // Comisión calculada
            $table->decimal('commission', 12, 2)->default(0);

            // Fechas del periodo
            $table->date('start');
            $table->date('end');

            $table->timestamps();

            // Restricciones
            $table->unique(['user_id', 'type', 'start', 'end']);
            $table->index(['start', 'end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
