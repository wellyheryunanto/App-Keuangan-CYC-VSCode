<?php

namespace Database\Factories;

use App\Models\BusinessDivision;
use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
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
            'business_division_id' => BusinessDivision::factory(),
            'client_id' => Client::factory(),
            'code' => fake()->unique()->bothify('PRJ-####'),
            'name' => fake()->sentence(3),
            'location' => fake()->address(),
            'start_date' => fake()->date(),
            'target_completion_date' => fake()->dateTimeBetween('+1 month', '+1 year')->format('Y-m-d'),
            'status' => 'planning',
        ];
    }
}
