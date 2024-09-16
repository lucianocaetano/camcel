<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            EnterpriseSeeder::class,
<<<<<<< HEAD
            OperatorSeeder::class,
=======
            UserSeeder::class,
>>>>>>> actividades_calendario
            UserAdminSeeder::class,
        ]);
    }
}
