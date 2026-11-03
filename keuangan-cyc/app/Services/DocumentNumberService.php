<?php

namespace App\Services;

use App\Models\Company;
use App\Models\DocumentSequence;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class DocumentNumberService
{
    public function next(string $documentType, Company $company): string
    {
        return DB::transaction(function () use ($documentType, $company): string {
            $sequence = DocumentSequence::query()
                ->whereBelongsTo($company)
                ->where('document_type', $documentType)
                ->lockForUpdate()
                ->first();

            if ($sequence === null) {
                throw (new ModelNotFoundException)->setModel(DocumentSequence::class);
            }

            $number = $sequence->next_number;
            $sequence->next_number = $number + 1;
            $sequence->save();

            return sprintf('%s%0*d', $sequence->prefix, $sequence->padding, $number);
        });
    }
}
