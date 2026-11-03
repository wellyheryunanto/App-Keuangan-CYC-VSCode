<?php

namespace App\Models;

use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['company_id', 'code', 'name', 'contact_person', 'tax_number', 'email', 'phone', 'address', 'is_active'])]
class Vendor extends Model
{
    /** @use HasFactory<VendorFactory> */
    use HasFactory, SoftDeletes;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
