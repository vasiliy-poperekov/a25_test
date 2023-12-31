<?php

namespace App\Http\Controllers;

use App\UseCases\PayForUnpaidTransactionsUseCase;
use Illuminate\Http\JsonResponse;

class PayForUnpaidTransactionsController extends Controller
{
    private PayForUnpaidTransactionsUseCase $payUseCase;

    public function __construct(PayForUnpaidTransactionsUseCase $payUseCase)
    {
        $this->payUseCase = $payUseCase;
    }

    public function pay(): JsonResponse
    {
        $this->payUseCase->handle();
        return response()->json(
            [
                'data' => [
                    'message' => 'Unpaid transactions have been paid',
                ],
            ],
            200
        );
    }
}
