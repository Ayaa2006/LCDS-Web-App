<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submited_tasks', function (Blueprint $table) {
            // Primary key - simplified definition
            $table->Integer('id_Sub_task')->autoIncrement();
            
            // Regular columns
            $table->Integer('id_task');
            $table->unsignedBigInteger('id_user');
            
            $table->string('status')->default('waiting');
            $table->text('files');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_task')
                  ->references('id')
                  ->on('tasks')
                  ->onDelete('cascade');
                  
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('submited_tasks');
    }
};