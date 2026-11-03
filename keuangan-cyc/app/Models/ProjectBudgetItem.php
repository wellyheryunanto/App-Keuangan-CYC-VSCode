<?php

namespace App\Models;

use Database\Factories\ProjectBudgetItemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['project_budget_id', 'transaction_category_id', 'unit_id', 'description', 'quantity', 'unit_price', 'tax_amount', 'line_total', 'sort_order'])]
class ProjectBudgetItem extends Model
{
    /** @use HasFactory<ProjectBudgetItemFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:4',
            'unit_price' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'line_total' => 'decimal:2',
        ];
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(ProjectBudget::class, 'project_budget_id');
    }

    public function transactionCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
