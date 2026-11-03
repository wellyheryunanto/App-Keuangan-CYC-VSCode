<?php

namespace App\Models;

use Database\Factories\ProjectBudgetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['project_id', 'supersedes_id', 'created_by', 'approved_by', 'revision_number', 'status', 'effective_date', 'approved_at'])]
class ProjectBudget extends Model
{
    /** @use HasFactory<ProjectBudgetFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'effective_date' => 'date',
            'approved_at' => 'datetime',
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProjectBudgetItem::class);
    }
}
