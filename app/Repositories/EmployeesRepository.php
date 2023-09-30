<?php

namespace App\Repositories;

use App\Models\Employees;

class EmployeesRepository
{
    public function create(string $email, string $hashedPassword): Employees
    {
        return Employees::create([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }
}
