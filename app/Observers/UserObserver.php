<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->house->makeHouseParticipation();
    }

    public function updated(User $user): void
    {
        $user->house->makeHouseParticipation();
    }

    public function deleted(User $user): void
    {
        $user->house->makeHouseParticipation();
    }
}
