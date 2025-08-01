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
        Schema::create('points_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->date('start');
            $table->date('end');
            $table->decimal('personal')->default(0);
            $table->decimal('unilevel', 10, 2)->default(0);
            $table->decimal('left_binary', 10, 2)->default(0);
            $table->decimal('right_binary', 10, 2)->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'start', 'end']);
            $table->index('user_id');
            $table->index('start');
            $table->index('end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_histories');
    }
};
