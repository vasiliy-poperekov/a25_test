<?php

use App\Http\Controllers\CreateEmployeeController;
use App\Http\Controllers\CreateTransactionController;
use App\Http\Controllers\GetTransactionsSumPerEmployeeController;
use App\Http\Controllers\PayForUnpaidTransactionsController;
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

Route::get(
    'transactions/sum',
    [GetTransactionsSumPerEmployeeController::class, 'getSumPerEmployee']
)->name('api.transactions.getSumPerEmployee');

Route::put(
    'transactions/pay',
    [PayForUnpaidTransactionsController::class, 'pay']
)->name('api.transactions.pay');
