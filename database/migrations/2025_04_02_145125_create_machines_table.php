<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('fournisseur');
            $table->date('date_achat');
            $table->decimal('prix', 10, 2);
            $table->text('maintenance_dates')->nullable(); // Pour stocker plusieurs dates
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('machines');
    }
};