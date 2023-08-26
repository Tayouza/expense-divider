<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelations
{
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }
}
