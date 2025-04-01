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
        Schema::create('gamifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level')->default(1);
            $table->integer('point')->default(0);
            $table->unsignedBigInteger('user_id')->index('gamifications_user_id_foreign');
            $table->string('Code', 7)->nullable();
            $table->string('friendCode', 7)->nullable();
            $table->integer('tasks_done');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamifications');
    }
};
