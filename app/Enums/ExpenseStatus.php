<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\EnumsHelper;

enum ExpenseStatus
{
    use EnumsHelper;

    case NEW;
    case PAID;
    case DUEDATE;

}
