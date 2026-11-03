<?php

namespace App\Models;

use Database\Factories\UnitFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'name'])]
class Unit extends Model
{
    /** @use HasFactory<UnitFactory> */
    use HasFactory;

    public function projectBudgetItems(): HasMany
    {
        return $this->hasMany(ProjectBudgetItem::class);
    }
}
