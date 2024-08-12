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
        $enterprise = Enterprise::factory()->create();

        return [
            "cedula" => uniqid(),
            "nombre" => $this->faker->name(),
            "autorizado" => $this->faker->boolean(),
            "cargo" => $this->faker->company(),
            "RUT_enterprise" => $enterprise->RUT 
        ];
    }
}
