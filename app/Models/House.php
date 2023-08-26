<?php

namespace App\Models;

use App\Models\Relations\HouseRelations;
use App\Models\Traits\HouseMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    use HouseMethods;
    use HouseRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
    ];
}
