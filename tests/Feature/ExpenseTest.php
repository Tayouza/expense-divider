<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('expenses')]
class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function when_accessing_should_return_success_response(): void
    {
        $response = $this->get('/expense/list');

        // $response->assertViewIs('');
        $response->assertStatus(200);
    }
}
