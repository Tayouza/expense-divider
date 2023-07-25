<?php

namespace Tests\Unit;

use App\Models\Expense;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('expenses')]
class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function teste(): void
    {
        $expense = Expense::factory()->create();
        
        
        $this->assertTrue(true);
    }
}
