<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\Operator;
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
        $users = User::factory()->create([
            "name" => "empresa",
            "email" => "empresa@gmail.com",
            "password" => "empresa",
            "rol" => "Enterprise"
        ]);

        $enterprises = Enterprise::factory()->create([
            'user_id' => $users->first()->id
        ]);

        Operator::factory(5)->create([
            'enterprise_id' => $enterprises->first()->id
        ]);
    }
}
