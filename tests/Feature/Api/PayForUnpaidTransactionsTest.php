<?php

namespace Tests\Feature\Api;

use App\Models\Employees;
use App\Models\Transactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayForUnpaidTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canPayForUnpaidTransactions(): void
    {
        $employee = Employees::factory()->create();
        Transactions::factory()->count(3)->create([
            'employee_id' => $employee->id,
        ]);

        $payResponse = $this->putJson(
            route('api.transactions.pay')
        );
        $payResponse->assertOk();

        $getUnapidResponse = $this->getJson(
            route('api.transactions.getSumPerEmployee')
        );
        $getUnapidResponse->assertOk();
        $getUnapidResponse->assertJsonMissing([
            'data' => [
                'employee_id' => $employee->id,
            ],
        ]);
    }
}
