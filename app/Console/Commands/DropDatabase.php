<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DropDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:drop-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function dropDatabase()
    {
        $dbname = env('DB_DATABASE');  // Récupère le nom de la base de données depuis .env
        DB::statement("DROP DATABASE IF EXISTS {$dbname}");
    }
}