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
        Schema::create('business_reports', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date')->nullable();
            $table->foreignId('business_data_id')->constrained('business_data');
            $table->string('user_dni')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('commission', 10, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->enum('status', ['pending_review', 'approved', 'rejected'])->default('pending_review');

            $table->string('invoice_number')->nullable(); // ahora es único
            $table->timestamps();
            // Índices adicionales útiles para búsquedas frecuentes
            $table->index('invoice_date');
            $table->index('status');
            $table->index('invoice_number');
            $table->unique(['business_data_id', 'invoice_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_reports');
    }
};
