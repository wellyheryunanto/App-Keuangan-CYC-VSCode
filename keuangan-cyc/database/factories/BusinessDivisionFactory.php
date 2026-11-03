<?php

namespace Database\Factories;

use App\Models\BusinessDivision;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BusinessDivision>
 */
class BusinessDivisionFactory extends Factory
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
            'code' => fake()->unique()->bothify('DIV-###'),
            'name' => fake()->word(),
            'is_active' => true,
        ];
    }
}
