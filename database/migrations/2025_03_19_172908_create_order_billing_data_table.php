<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_billing_data', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name')->nullable(); // Nombre completo / Razón social
            $table->foreignId('document_type_id')->nullable()->constrained('document_types')->cascadeOnUpdate();
            $table->string('document')->nullable()->index(); // Número de documento
            $table->string('email')->nullable()->index();   // Email para factura electrónica
            $table->string('phone')->nullable();

            $table->foreignId('country_id')->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('addCity')->nullable(); // Para agregar ciudad manual
            $table->text('address')->nullable();   // Dirección fiscal

            $table->timestamps();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_billing_data');
    }
};
