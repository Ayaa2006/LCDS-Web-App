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
        Schema::create('agenda_crm', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->string('telephone');
            $table->string('email');
            $table->text('adresse_postale');
            $table->enum('etat_advertissement', ['en_attente', 'confirme', 'annule']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_c_r_m_s');
    }
};
