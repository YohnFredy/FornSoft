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
        Schema::create('business_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onDelete('cascade');

            // Información general
            $table->enum('store_type', ['online', 'physical', 'hybrid'])->default('physical');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website_url')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable(); // Descripción de la empresa

            // Ubicación
            $table->string('country')->nullable();
            $table->string('department')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();


            // Redes sociales (campos opcionales)
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('x_url')->nullable(); // Twitter (X)

            // Multimedia
            $table->string('promo_video_url')->nullable(); // video promocional principal
            $table->json('additional_videos')->nullable(); // otros videos si aplica

            // Otros enlaces personalizados
            $table->json('custom_links')->nullable(); // por ejemplo enlaces a catálogos, PDF, etc.

            $table->timestamps();

            // Índices para mejorar rendimiento en búsquedas y filtros

            $table->index(['latitude', 'longitude']);
            $table->index('store_type');
            $table->index('country');
            $table->index('department');
            $table->index('city');
            $table->index('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_data');
    }
};
