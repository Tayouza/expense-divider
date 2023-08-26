<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HouseRelations
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
