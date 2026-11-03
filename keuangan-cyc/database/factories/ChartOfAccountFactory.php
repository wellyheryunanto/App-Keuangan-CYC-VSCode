<?php

namespace Database\Factories;

use App\Models\ChartOfAccount;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChartOfAccount>
 */
class ChartOfAccountFactory extends Factory
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
            'code' => fake()->unique()->numerify('1####'),
            'name' => fake()->words(2, true),
            'account_type' => 'asset',
            'normal_balance' => 'debit',
            'is_postable' => true,
            'is_active' => true,
        ];
    }
}
