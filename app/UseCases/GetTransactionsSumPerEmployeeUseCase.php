<?php

namespace App\UseCases;

use App\Repositories\TransactionsRepository;

class GetTransactionsSumPerEmployeeUseCase
{
    private TransactionsRepository $repository;

    public function __construct()
    {
        $this->repository = new TransactionsRepository();
    }

    public function handle(): array
    {
        $data = [];
        $salaryPerHour = 100;

        foreach($this->repository->getAllUnpaidPerEmployee() as $element)
        {
            $data[$element->employee_id] = $element->hours * $salaryPerHour;
        }
        return $data;
    }
}
