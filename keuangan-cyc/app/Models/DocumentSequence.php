<?php

namespace App\Models;

use Database\Factories\DocumentSequenceFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['company_id', 'document_type', 'prefix', 'next_number', 'padding'])]
class DocumentSequence extends Model
{
    /** @use HasFactory<DocumentSequenceFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'next_number' => 'integer',
            'padding' => 'integer',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
