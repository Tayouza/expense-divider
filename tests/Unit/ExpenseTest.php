<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('expenses')]
class ExpenseTest extends TestCase
{
    #[Test]
    public function (): void
    {
        $expense = new Expense;
        
        $this->assertTrue(true);
    }
}
