<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
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
            'code' => fake()->unique()->bothify('VEN-####'),
            'name' => fake()->company(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'is_active' => true,
        ];
    }
}
