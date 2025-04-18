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
    public function up()
{
    Schema::create('rang', function (Blueprint $table) {
        $table->id();
        $table->string('libelle', 100);
        $table->integer('point_min');
        $table->integer('point_max');
        $table->text('description')->nullable();
        $table->timestamps();
    });
    // Insert default data
    DB::table('rang')->insert([
        ['id' => 1, 'libelle' => 'Recrue', 'point_min' => 0, 'point_max' => 499, 'description' => 'Premier pas dans le systeme de gamification'],
        ['id' => 2, 'libelle' => 'Apprenti', 'point_min' => 500, 'point_max' => 999, 'description' => 'Commencant a comprendre le systeme'],
        ['id' => 3, 'libelle' => 'Novice', 'point_min' => 1000, 'point_max' => 1999, 'description' => 'Progressant rapidement'],
        ['id' => 4, 'libelle' => 'Adepte', 'point_min' => 2000, 'point_max' => 3999, 'description' => 'Maitrisant les bases'],
        ['id' => 5, 'libelle' => 'Expert', 'point_min' => 4000, 'point_max' => 5999, 'description' => 'Devenant un professionnel'],
        ['id' => 6, 'libelle' => 'Maitre', 'point_min' => 6000, 'point_max' => 8999, 'description' => 'Niveau de competence eleve'],
        ['id' => 7, 'libelle' => 'Champion', 'point_min' => 9000, 'point_max' => 12999, 'description' => 'Atteignant l\'excellence'],
        ['id' => 8, 'libelle' => 'Legende', 'point_min' => 13000, 'point_max' => 19999, 'description' => 'Presque au sommet'],
        ['id' => 9, 'libelle' => 'Heros', 'point_min' => 20000, 'point_max' => 29999, 'description' => 'Niveau exceptionnel'],
        ['id' => 10, 'libelle' => 'Genie', 'point_min' => 30000, 'point_max' => 49999, 'description' => 'Sommet de la performance'],
        ['id' => 11, 'libelle' => 'Icone', 'point_min' => 50000, 'point_max' => 79999, 'description' => 'Reference dans le systeme'],
        ['id' => 12, 'libelle' => 'Virtuose', 'point_min' => 80000, 'point_max' => 99999, 'description' => 'Niveau ultime de maitrise'],
        ['id' => 13, 'libelle' => 'Legendaire', 'point_min' => 100000, 'point_max' => 199999, 'description' => 'Au-dela de l\'excellence'],
        ['id' => 14, 'libelle' => 'Immortel', 'point_min' => 200000, 'point_max' => 499999, 'description' => 'Statut mythique'],
        ['id' => 15, 'libelle' => 'Divin', 'point_min' => 500000, 'point_max' => 999999999, 'description' => 'Le summum de la performance'],
    ]);
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rang');
    }
};
