<?php

namespace Tests\Unit;

use App\Models\Transactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTransactionRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $routePrefix = 'api.transactions.create';

    /** @test */
    public function employeeIdIsRequired()
    {
        $validatedField = 'employee_id';
        $brokenRule = null;

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function employeeIdMustExist()
    {
        $validatedField = 'employee_id';
        $brokenRule = 0;

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function employeeIdMustBeInteger()
    {
        $validatedField = 'employee_id';
        $brokenRule = 'asdf';

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function hoursIsRequired()
    {
        $validatedField = 'hours';
        $brokenRule = null;

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function hoursIsInteger()
    {
        $validatedField = 'hours';
        $brokenRule = 'something';

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function hoursMustNotBeLessOne()
    {
        $validatedField = 'hours';
        $brokenRule = -1;

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function hoursMustNotBeMoreTwelve()
    {
        $validatedField = 'hours';
        $brokenRule = 14;

        $transaction = Transactions::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $transaction->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }
}
