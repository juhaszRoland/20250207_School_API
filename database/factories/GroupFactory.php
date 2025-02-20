<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => $this->faker->randomElement(['9', '10', '11', '12', '13', '14']),
            'class' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
        ];
    }
}
