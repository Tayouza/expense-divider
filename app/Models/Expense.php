<?php

namespace App\Models;

use App\Models\Relations\ExpenseRelations;
use App\Models\Traits\ExpenseMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    use ExpenseMethods;
    use ExpenseRelations;

    const NEW = 'NEW';

    const DUEDATE = 'DUEDATE';

    const PAID = 'PAID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'expense_list_id',
        'name',
        'value',
        'duedate',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duedate' => 'date',
    ];
}
