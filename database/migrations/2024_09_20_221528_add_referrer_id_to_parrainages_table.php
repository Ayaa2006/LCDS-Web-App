<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::table('parrainages', function (Blueprint $table) {
        $table->unsignedBigInteger('referrer_id')->nullable(); // Add this line
    });
}

public function down()
{
    Schema::table('parrainages', function (Blueprint $table) {
        $table->dropColumn('referrer_id');
    });
}
};

