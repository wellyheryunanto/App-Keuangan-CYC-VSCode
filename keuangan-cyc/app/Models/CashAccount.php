<?php

namespace App\Models;

use Database\Factories\CashAccountFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['company_id', 'chart_of_account_id', 'code', 'name', 'account_type', 'bank_name', 'account_number', 'is_active'])]
class CashAccount extends Model
{
    /** @use HasFactory<CashAccountFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'account_number' => 'encrypted',
            'is_active' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function chartOfAccount(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class);
    }
}
