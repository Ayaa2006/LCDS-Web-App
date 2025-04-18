<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('gamifications', function (Blueprint $table) {
        $table->unsignedBigInteger('id_rang')->default(1)->after('tasks_done');
        $table->foreign('id_rang')->references('id')->on('rang')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gamifications', function (Blueprint $table) {
            //
        });
    }
};
