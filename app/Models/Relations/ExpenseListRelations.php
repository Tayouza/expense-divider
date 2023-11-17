<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\Expense;
use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ExpenseListRelations
{
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }
}
