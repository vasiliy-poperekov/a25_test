<?php

namespace Tests\Unit;

use App\Models\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEmployeeRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $routePrefix = 'api.employees.create';

    /** @test */
    public function emailIsRequired(): void
    {
        $validatedField = 'email';
        $brokenRule = null;

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function emailMustBeCorrect(): void
    {
        $validatedField = 'email';
        $brokenRule = 'email';

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function emailMustBeUnique(): void
    {
        $createdEmployee = Employees::factory()->create();
        $validatedField = 'email';
        $brokenRule = $createdEmployee->email;

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function passwordIsRequired(): void
    {
        $validatedField = 'password';
        $brokenRule = null;

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function passwordMustBeNotLess6Characters(): void
    {
        $validatedField = 'password';
        $brokenRule = '12345';

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }

    /** @test */
    public function passwordMustBeNotMore10Characters(): void
    {
        $validatedField = 'password';
        $brokenRule = '12345678901';

        $employee = Employees::factory()->make([
            $validatedField => $brokenRule,
        ]);

        $response = $this->postJson(
            route($this->routePrefix),
            $employee->toArray()
        );

        $response->assertJsonValidationErrors($validatedField);
    }
}
