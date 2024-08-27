<?php

namespace Database\Factories;

use App\Models\Operator;
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
        $path = storage_path("app/public/enterprises/");

        $image = $this->faker->image($path, 50, 50, null, false);

        $name = $this->faker->name();
        $rut = $this->faker->uuid();

        Operator::factory(10)->create([
            "RUT_enterprise" => $rut
        ]);

        return [
            "RUT" => $rut,
            "nombre" => $name,
            "slug" => str($name." ".uniqid())->slug(),
            "image" => "storage/enterprises/".$image,
            "is_valid" => $this->faker->boolean(),
            "user_id" => User::factory()
        ];
    }
}
