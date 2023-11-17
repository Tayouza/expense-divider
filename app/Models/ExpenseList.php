<?php

namespace App\Models;

use App\Models\Relations\ExpenseListRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseList extends Model
{
    use HasFactory;
    use ExpenseListRelations;

    protected $fillable = [
        'name',
        'house_id',
    ];
}
