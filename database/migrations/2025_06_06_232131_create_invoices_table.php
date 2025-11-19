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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('business_data_id')->constrained('business_data');
            $table->string('invoice_number')->nullable(); // ahora es único
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->decimal('pts', 10, 2)->default(0)->check('pts >= 0');
            $table->date('invoice_date')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->boolean('locked')->default(false);
            $table->string('currency', 10)->nullable();
            $table->string('image_path');
            $table->enum('status', ['pending_review', 'approved', 'rejected', 'ocr_failed'])->default('pending_review');
            $table->text('review_notes')->nullable();
            $table->timestamps();

            // Índices adicionales útiles para búsquedas frecuentes
            $table->index('invoice_date');
            $table->index('status');
            $table->index('start');
            $table->index('end');
            $table->index('locked');

            $table->unique(['business_data_id', 'invoice_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
