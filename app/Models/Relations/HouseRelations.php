<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\ExpenseList;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HouseRelations
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function expenselist(): HasMany
    {
        return $this->hasMany(ExpenseList::class);
    }
}
