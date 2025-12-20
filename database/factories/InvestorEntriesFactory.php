<?php

namespace Database\Factories;

use App\Models\Investors;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Investors>
 */
class InvestorEntriesFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'investor_id' => Investors::pluck('id')->random(),
            'investment_amount',
            'investment_date',
        ];
    }
}
