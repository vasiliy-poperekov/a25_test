<?php

namespace App\UseCases;

use App\Dao\PayDao;

class PayForUnpaidTransactionsUseCase
{
    private PayDao $payDao;

    public function __construct(PayDao $payDao)
    {
        $this->payDao = $payDao;
    }
    
    public function handle(): void
    {
        $this->payDao->pay();
    }
}
