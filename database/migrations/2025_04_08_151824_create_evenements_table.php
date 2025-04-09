<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('nomEvent');
            $table->text('description');
            $table->string('mediaAssocie')->nullable();
            $table->enum('statut', ['publie', 'supprimer', 'archive'])->default('publie');
            $table->dateTime('datePublication')->nullable();
            $table->integer('nbrDeJours');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
