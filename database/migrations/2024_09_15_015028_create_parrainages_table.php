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
        Schema::create('parrainages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reff_id')->nullable();
            $table->unsignedBigInteger('user_id')->index(); // L'utilisateur qui a généré le code
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parrainages');
    }
};
