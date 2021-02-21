<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');
        // \App\Models\User::factory(10)->create();
        \DB::unprepared(file_get_contents(__dir__ . '\source\almedah_erp_db.sql'));
    }
}
