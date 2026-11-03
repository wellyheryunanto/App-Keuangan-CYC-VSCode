<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionCategory>
 */
class TransactionCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'code' => fake()->unique()->bothify('CAT-###'),
            'name' => fake()->words(2, true),
            'direction' => 'expense',
            'is_active' => true,
        ];
    }
}
