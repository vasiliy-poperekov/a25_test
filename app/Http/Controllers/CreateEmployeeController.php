<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\UseCases\CreateEmployeeUseCase;
use Illuminate\Http\JsonResponse;

class CreateEmployeeController extends Controller
{
    private CreateEmployeeUseCase $createEmployeeUseCase;

    public function __construct()
    {
        $this->createEmployeeUseCase = new CreateEmployeeUseCase();
    }

    public function create(CreateEmployeeRequest $request): JsonResponse
    {
        $employee = $this->createEmployeeUseCase->handle(
            $request->input('email'),
            $request->input('password')
        );

        return response()->json(
            [
                'data' => [
                    'id' => $employee->id,
                    'email' => $employee->email,
                ],
            ],
            201
        );
    }
}
