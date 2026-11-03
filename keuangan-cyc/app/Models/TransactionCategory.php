<?php

namespace App\Models;

use Database\Factories\TransactionCategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['company_id', 'parent_id', 'default_account_id', 'code', 'name', 'direction', 'is_active'])]
class TransactionCategory extends Model
{
    /** @use HasFactory<TransactionCategoryFactory> */
    use HasFactory;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function defaultAccount(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'default_account_id');
    }

    public function projectBudgetItems(): HasMany
    {
        return $this->hasMany(ProjectBudgetItem::class);
    }
}
