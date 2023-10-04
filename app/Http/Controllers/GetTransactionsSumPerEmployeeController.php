<?php

namespace App\Http\Controllers;

use App\UseCases\GetTransactionsSumPerEmployeeUseCase;
use Illuminate\Http\JsonResponse;

class GetTransactionsSumPerEmployeeController extends Controller
{
    private GetTransactionsSumPerEmployeeUseCase $getTransSumPerEmpUseCase;

    public function __construct()
    {
        $this->getTransSumPerEmpUseCase = new GetTransactionsSumPerEmployeeUseCase();
    }

    public function getSumPerEmployee(): JsonResponse
    {
        $this->getTransSumPerEmpUseCase->handle();
        return response()->json(
            [
                'data' => $this->getTransSumPerEmpUseCase->handle(),
            ],
            200
        );
    }
}
