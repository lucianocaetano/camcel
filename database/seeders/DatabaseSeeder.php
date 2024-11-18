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
            UserEnterpriseSeeder::class,
            EnterpriseSeeder::class,
            OperatorSeeder::class,
            DocumentSeeder::class,
            UserSeeder::class,
            UserAdminSeeder::class,
            JobSeeder::class,
        ]);
    }
}
