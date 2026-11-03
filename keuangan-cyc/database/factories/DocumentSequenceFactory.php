<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\DocumentSequence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocumentSequence>
 */
class DocumentSequenceFactory extends Factory
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
            'document_type' => fake()->unique()->word(),
            'prefix' => 'DOC-',
            'next_number' => 1,
            'padding' => 4,
        ];
    }
}
