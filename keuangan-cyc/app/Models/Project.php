<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['company_id', 'business_division_id', 'client_id', 'manager_user_id', 'code', 'name', 'location', 'description', 'start_date', 'target_completion_date', 'status'])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'target_completion_date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function businessDivision(): BelongsTo
    {
        return $this->belongsTo(BusinessDivision::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withPivot(['project_role', 'assigned_at']);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(ProjectContract::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(ProjectBudget::class);
    }
}
