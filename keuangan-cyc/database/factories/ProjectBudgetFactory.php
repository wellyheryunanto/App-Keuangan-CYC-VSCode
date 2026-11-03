<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectBudget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectBudget>
 */
class ProjectBudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'created_by' => User::factory(),
            'revision_number' => 1,
            'status' => 'draft',
        ];
    }
}
