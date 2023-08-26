<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;

trait ExpenseMethods
{
    public function getValueToPayForUser(User $user)
    {
        $houseParticipation = $user->house_participation;

        return $this->value * ($houseParticipation / 100);
    }
}
