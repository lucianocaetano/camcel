<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enterprise>
 */
class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "RUT" => $this->faker->uuid(),
            "nombre" => $this->faker->name(),
            "is_valid" => $this->faker->boolean(),
            "user_id" => User::factory()
        ];
    }
}
