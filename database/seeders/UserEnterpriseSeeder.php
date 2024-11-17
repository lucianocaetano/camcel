<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserEnterpriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "empresa",
            "email" => "empresa@gmail.com",
            "password" => "empresa",
            "rol" => "Enterprise"
        ]);

        $user = User::where("name", "empresa")->first();

        Enterprise::factory()->create([
            'user_id' => $user->id
        ]);
    }
}
