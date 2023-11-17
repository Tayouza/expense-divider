<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\ExpenseList;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ExpenseRelations
{
    public function expenseList(): BelongsTo
    {
        return $this->belongsTo(ExpenseList::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
