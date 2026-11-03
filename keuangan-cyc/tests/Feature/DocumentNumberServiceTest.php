<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\DocumentSequence;
use App\Services\DocumentNumberService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentNumberServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_numbers_increment_and_use_the_configured_prefix(): void
    {
        $company = Company::factory()->create();
        DocumentSequence::factory()->for($company)->create([
            'document_type' => 'project',
            'prefix' => 'CYC-PRJ-',
            'next_number' => 1,
            'padding' => 4,
        ]);

        $service = app(DocumentNumberService::class);

        $firstNumber = $service->next('project', $company);
        $secondNumber = $service->next('project', $company);

        $this->assertSame('CYC-PRJ-0001', $firstNumber);
        $this->assertSame('CYC-PRJ-0002', $secondNumber);
        $this->assertDatabaseHas('document_sequences', [
            'company_id' => $company->id,
            'document_type' => 'project',
            'next_number' => 3,
        ]);
    }
}
