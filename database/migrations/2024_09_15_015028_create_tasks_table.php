<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->string('description');
            $table->integer('point');
            $table->boolean('CanLink')->default(true);
             // Add timestamps
             $table->timestamps(); // This will create both 'created_at' and 'updated_at'
        });

        // Insert default data
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'title' => 'Prise de Photo à Distance',
                'description' => 'Prise de Photo à Distance',
                'point' => 500,
                'CanLink' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
