<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enterprises = Enterprise::all();

        foreach ($enterprises as $enterprise) {
            Operator::factory(5)->create(["enterprise_id"=>$enterprise->id]);
        }
    }
}
