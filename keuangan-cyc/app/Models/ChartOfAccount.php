<?php

namespace App\Models;

use Database\Factories\ChartOfAccountFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['company_id', 'parent_id', 'code', 'name', 'account_type', 'normal_balance', 'is_postable', 'is_active'])]
class ChartOfAccount extends Model
{
    /** @use HasFactory<ChartOfAccountFactory> */
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

    public function cashAccount(): HasOne
    {
        return $this->hasOne(CashAccount::class);
    }
}
