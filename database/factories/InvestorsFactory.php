<?php

namespace Database\Factories;

use App\Models\Investors;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Investors>
 */
class InvestorsFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'age' => rand(1, 100),
        ];
    }
}
