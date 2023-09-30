<?php

namespace Tests\Feature\Api;

use App\Models\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canCreateEmployee(): void
    {
        $employee = Employees::factory()->make();

        $response = $this->postJson(
            route('api.employees.create'),
            $employee->toArray()
        );

        $response->assertCreated();
        $this->assertDatabaseHas('employees', ['email' => $employee->email]);
    }
}
