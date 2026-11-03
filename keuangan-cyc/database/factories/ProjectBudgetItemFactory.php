<?php

namespace Database\Factories;

use App\Models\ProjectBudget;
use App\Models\ProjectBudgetItem;
use App\Models\TransactionCategory;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectBudgetItem>
 */
class ProjectBudgetItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_budget_id' => ProjectBudget::factory(),
            'transaction_category_id' => TransactionCategory::factory()->state(['direction' => 'expense']),
            'unit_id' => Unit::factory(),
            'description' => fake()->words(3, true),
            'quantity' => 1,
            'unit_price' => fake()->randomFloat(2, 1000, 10000000),
            'tax_amount' => 0,
            'line_total' => 1000,
        ];
    }
}
