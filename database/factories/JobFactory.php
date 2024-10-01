<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->title();

        return [
            "title" => $title,
            "slug" => str($title." ".uniqid())->slug()->value(),
            "is_check" => $this->faker->boolean(),
            "is_check_enterprise" => $this->faker->boolean(),
            "date" => $this->faker->date(),
            "in_time" => $this->faker->time(),
            "out_time" => $this->faker->time(),
        ];
    }
}
