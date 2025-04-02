<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('decors', function (Blueprint $table) {
            $table->id();
            $table->string('nom_box');
            $table->date('date_acquisition');
            $table->string('fournisseur');
            $table->date('date_exposition')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decors');
    }
};
