<?php

namespace App\UseCases;

use App\Repositories\TransactionsRepository;

class PayForUnpaidTransactionsUseCase
{
    private TransactionsRepository $repository;

    public function __construct()
    {
        $this->repository = new TransactionsRepository();
    }
    
    public function handle(): void
    {
        $this->repository->payForAllUnpaid();
    }
}
