<?php

namespace App\UseCases;

use App\Models\Transactions;
use App\Repositories\TransactionsRepository;
use DateTimeImmutable;
use Exception;

class CreateTransactionUseCase
{
    private TransactionsRepository $repository;

    public function __construct()
    {
        $this->repository = new TransactionsRepository();
    }

    public function handle(int $employeeId, int $hours): Transactions
    {
        $previousTransaction = $this->repository->getLastByEmployeeId($employeeId);

        if (
            !is_null($previousTransaction) &&
            (new DateTimeImmutable(
                explode(' ', $previousTransaction->created_at)[0]
            )
            ) == (new DateTimeImmutable())->setTime(0, 0)
        ) {
            throw new Exception(
                'Transaction was already created today',
                400
            );
        }

        return $this->repository->create($employeeId, $hours);
    }
}
