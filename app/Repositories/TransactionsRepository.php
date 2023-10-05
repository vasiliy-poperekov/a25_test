<?php

namespace App\Repositories;

use App\Dao\PayDao;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Collection;

class TransactionsRepository implements PayDao
{
    public function create(int $employeeId, int $hours): Transactions
    {
        return Transactions::create([
            'employee_id' => $employeeId,
            'hours' => $hours,
        ]);
    }

    public function getAllUnpaidPerEmployee(): Collection
    {
        return Transactions::where('is_paid', false)->groupBy('employee_id')
        ->selectRaw('employee_id, sum(hours) as hours')
        ->get();
    }

    public function getLastByEmployeeId(int $employeeId): ?Transactions
    {
        return Transactions::where('employee_id', $employeeId)
            ->orderByDesc('created_at')
            ->first();
    }

    public function pay(int $chunkSize = self::OPTIMAL_SELECT_CHUNK): void
    {
        Transactions::where('is_paid', false)->chunkById($chunkSize, function (Collection $transactions) {
            foreach ($transactions as $transaction) {
                $transaction->update(['is_paid' => true]);
            }
        });
    }
}
