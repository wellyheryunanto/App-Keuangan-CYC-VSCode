<?php

namespace App\Models;

use Database\Factories\ProjectContractFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['project_id', 'supersedes_id', 'version_number', 'contract_number', 'signed_date', 'effective_date', 'contract_value', 'status', 'file_path'])]
class ProjectContract extends Model
{
    /** @use HasFactory<ProjectContractFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'signed_date' => 'date',
            'effective_date' => 'date',
            'contract_value' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function supersedes(): BelongsTo
    {
        return $this->belongsTo(self::class, 'supersedes_id');
    }
}
