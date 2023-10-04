<?php

namespace Tests\Feature;

use App\Models\Employees;
use App\Models\Transactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTransactionSumPerEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canGetTransactionSumByEmployees(): void
    {
        $transactionsSum1 = 0;
        $salaryPerHour = 100;
        $employee1 = Employees::factory()->create();
        $employee2 = Employees::factory()->create();
        $transactions1 = Transactions::factory()->count(3)->create([
            'employee_id' => $employee1->id,
        ]);
        Transactions::factory()->count(3)->create([
            'employee_id' => $employee2->id,
            'is_paid' => true,
        ]);

        foreach ($transactions1 as $transaction) {
            $transactionsSum1 += $transaction->hours * $salaryPerHour;
        }

        $response = $this->getJson(
            route('api.transactions.getSumPerEmployee')
        );

        $response->assertOk();
        $response->assertJson([
            'data' => [
                $employee1->id => $transactionsSum1,
            ],
        ]);
    }
}
