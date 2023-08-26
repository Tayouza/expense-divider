<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ExpenseRelations
{
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }
}
