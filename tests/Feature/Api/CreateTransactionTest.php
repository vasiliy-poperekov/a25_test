<?php

namespace Tests\Feature\Api;

use App\Models\Transactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canCreateTransaction(): void
    {
        $transaction = Transactions::factory()->make();

        $response = $this->postJson(
            route('api.transactions.create'),
            $transaction->toArray()
        );

        $response->assertCreated();
        $this->assertDatabaseHas('transactions', [
            'employee_id' => $transaction->employee_id,
        ]);
    }

    /** @test */
    public function cantCreateTwoTransactionInOneDay(): void
    {
        $previousTransaction = Transactions::factory()->create();

        $transaction = Transactions::factory()->make([
            'employee_id' => $previousTransaction->employee_id,
        ]);
        $response = $this->postJson(
            route('api.transactions.create'),
            $transaction->toArray()
        );

        $response->assertJson([
            'data' => [
                'message' => 'Transaction was already created today',
            ],
        ]);
        $this->assertTrue($response->getStatusCode() === 400);
    }
}
