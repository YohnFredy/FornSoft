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
        Schema::create('binary_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnDelete();
            $table->decimal('personal')->default(0);
            $table->decimal('left_points')->default(0);
            $table->decimal('right_points')->default(0);
            $table->boolean('locked')->default(false);
            $table->dateTime('approved')->nullable();
            $table->timestamps();
            $table->index('user_id');
            $table->index('locked');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binary_points');
    }
};
