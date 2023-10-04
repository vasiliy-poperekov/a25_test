<?php

namespace App\Repositories;

use App\Models\Transactions;

class TransactionsRepository
{
    private const OPTIMAL_CHUNK_SIZE = 1;
    public function create(int $employeeId, int $hours): Transactions
    {
        return Transactions::create([
            'employee_id' => $employeeId,
            'hours' => $hours,
        ]);
    }

    public function getByEmployeeId(
        int $employeeId,
        int $optimalChunkSize = self::OPTIMAL_CHUNK_SIZE
    ) {
        return Transactions::where('employee_id', $employeeId)->chunk($optimalChunkSize);
    }

    public function getLastByEmployeeId(int $employeeId): ?Transactions
    {
        return Transactions::where('employee_id', $employeeId)
            ->orderByDesc('created_at')
            ->first();
    }
}
