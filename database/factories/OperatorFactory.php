<?php

namespace Database\Factories;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operator>
 */
class OperatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        return [
            "ci" => uniqid(),
            "name" => $this->faker->name(),
            "authorized" => $this->faker->boolean(),
            "role_description" => $this->faker->company(),
        ];
    }
}
