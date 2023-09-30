<?php

namespace App\UseCases;

use App\Models\Employees;
use App\Repositories\EmployeesRepository;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeUseCase
{
    private EmployeesRepository $repository;

    public function __construct()
    {
        $this->repository = new EmployeesRepository();
    }

    public function handle(string $email, string $password): Employees
    {
        return $this->repository->create(
            $email,
            Hash::make($password)
        );
    }
}
