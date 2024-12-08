<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Enterprise;
use App\Models\Operator;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enterprises = Enterprise::all();
        $operators = Operator::all();

        foreach ($enterprises as $enterprise) {
            Document::factory(30)->create([
                "enterprise_id" => $enterprise->id
            ]);
        }

        foreach ($operators as $operator) {
            Document::factory(30)->create([
                "operator_id" => $operator->id
            ]);
        }
    }
}
