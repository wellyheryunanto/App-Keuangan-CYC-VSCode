<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'legal_name', 'tax_number', 'address', 'email', 'phone', 'currency_code', 'timezone', 'is_active'])]
class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    public function businessDivisions(): HasMany
    {
        return $this->hasMany(BusinessDivision::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }

    public function chartOfAccounts(): HasMany
    {
        return $this->hasMany(ChartOfAccount::class);
    }

    public function cashAccounts(): HasMany
    {
        return $this->hasMany(CashAccount::class);
    }

    public function transactionCategories(): HasMany
    {
        return $this->hasMany(TransactionCategory::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function documentSequences(): HasMany
    {
        return $this->hasMany(DocumentSequence::class);
    }
}
