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
        Schema::create('consent_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('contract_version_accepted'); // ej: 'v1.0-202503'
            $table->string('privacy_policy_version_accepted'); // ej: 'v1.2-202501'

            // Usamos 'accepted_at' para el momento del clic. `precision: 6` para milisegundos.
            $table->timestamp('accepted_at', 6);

            $table->ipAddress('ip_address');
            $table->text('user_agent');
            $table->text('checkbox_text');

            // created_at y updated_at. 'created_at' será casi idéntico a 'accepted_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consent_logs');
    }
};
