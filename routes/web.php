<?php

use App\Http\Controllers\CreateEmployeeController;
use App\Http\Controllers\CreateTransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post(
    'employees',
    [CreateEmployeeController::class, 'create']
)->name('api.employees.create');

Route::post(
    'transactions',
    [CreateTransactionController::class, 'create']
)->name('api.transactions.create');
