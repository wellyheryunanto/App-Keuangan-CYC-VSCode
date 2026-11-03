<?php

namespace App\Models;

use Database\Factories\BusinessDivisionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['company_id', 'code', 'name', 'description', 'is_active'])]
class BusinessDivision extends Model
{
    /** @use HasFactory<BusinessDivisionFactory> */
    use HasFactory;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
