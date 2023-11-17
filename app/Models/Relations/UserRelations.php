<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelations
{
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
