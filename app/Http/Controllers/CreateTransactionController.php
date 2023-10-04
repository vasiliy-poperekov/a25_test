<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\UseCases\CreateTransactionUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class CreateTransactionController extends Controller
{
    private CreateTransactionUseCase $createTransactionUseCase;

    public function __construct()
    {
        $this->createTransactionUseCase = new CreateTransactionUseCase();
    }
    public function create(CreateTransactionRequest $request): JsonResponse
    {
        try {
            $transaction = $this->createTransactionUseCase->handle(
                $request->input('employee_id'),
                $request->input('hours')
            );

        } catch (Exception $e) {
            return response()->json(
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ],
                $e->getCode(),
            );
        }

        return response()->json(
            [
                'data' => [
                    'id' => $transaction->id,
                    'employee_id' => $transaction->employee_id,
                    'hours' => $transaction->hours,
                ],
            ],
            201
        );
    }
}
