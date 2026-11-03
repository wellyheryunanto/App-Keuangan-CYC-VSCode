<?php

namespace Database\Factories;

use App\Models\CashAccount;
use App\Models\ChartOfAccount;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CashAccount>
 */
class CashAccountFactory extends Factory
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
            'chart_of_account_id' => ChartOfAccount::factory(),
            'code' => fake()->unique()->bothify('CASH-###'),
            'name' => fake()->word().' account',
            'account_type' => 'cash',
            'is_active' => true,
        ];
    }
}
