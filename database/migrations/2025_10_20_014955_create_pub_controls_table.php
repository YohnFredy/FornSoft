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
        Schema::create('pub_controls', function (Blueprint $table) {

           $table->id();
           $table->foreignId('user_id')->constrained()->onDelete('restrict'); 
           $table->unsignedInteger('total_assigned')->default(0)->index(); // cantidad de afiliados asignados 
           $table->decimal('ad_value', 10, 2)->default(0)->index(); // valor invertido en publicidad 
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pub_controls');
    }
};
