<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Enterprise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enterprises = Enterprise::all();

        foreach ($enterprises as $enterprise) {
            Document::factory(5)->create([
                "enterprise_id" => $enterprise->id
            ]);
        }

        /*
            'operator_id',
            'enterprise_id',
            'job_id',

         */
    }
}
