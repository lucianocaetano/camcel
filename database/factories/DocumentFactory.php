<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Document;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            "url_document" => "storage/documents/test_document.pdf",
            "title" => $this->faker->name(),
            "expire" => $this->faker->date(),
            "is_valid" => $this->faker->boolean(),
        ];
    }
}
