<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Helpers\Helpers;
use App\Models\User;

trait HouseMethods
{
    public function makeHouseParticipation()
    {
        $usersInHouse = $this->users;
        $totalIncome = $this->getTotalIncomeHouse();

        $usersInHouse->map(function (User $user) use ($totalIncome) {
            $houseParticipation = Helpers::ruleOfThree($user->income, $totalIncome);
            $user->house_participation = round($houseParticipation, mode: PHP_ROUND_HALF_DOWN);
            $user->save();
        });

    }

    public function getTotalIncomeHouse()
    {
        $usersInHouse = $this->users;

        return $usersInHouse->map(
            fn (User $user) => $user->income
        )
            ->sum();
    }
}
