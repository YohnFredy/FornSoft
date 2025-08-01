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
        Schema::create('purchase_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onUpdate('cascade');
            $table->string('invoice_number');
            $table->string('currency', 10)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('pts', 8, 2)->default(0);
            $table->date('invoice_date')->nullable();
            $table->string('image_path');
            $table->enum('status', ['pending_review', 'approved', 'rejected', 'failed'])->default('pending_review');
            $table->text('review_notes')->nullable();

            $table->timestamps();
            $table->index('invoice_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_supports');
    }
};
