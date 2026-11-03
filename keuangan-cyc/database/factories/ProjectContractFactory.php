<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectContract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectContract>
 */
class ProjectContractFactory extends Factory
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
            'version_number' => 1,
            'contract_number' => fake()->unique()->bothify('CTR-#####'),
            'effective_date' => fake()->date(),
            'contract_value' => fake()->randomFloat(2, 1000000, 1000000000),
            'status' => 'draft',
        ];
    }
}
