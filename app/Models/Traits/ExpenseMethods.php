<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;

trait ExpenseMethods
{
    public function getValueToPayForUser(User $user)
    {
        if ($this->user_id) {
            if ($this->user_id === $user->id) {
                return $this->value;
            }

            return 0;
        }

        $houseParticipation = $user->house_participation;

        return $this->value * ($houseParticipation / 100);
    }
}
