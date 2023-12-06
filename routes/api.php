<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Для работы с авторизацией
Route::group(['namespace' => 'App\Http\Controllers\Auth', 'prefix' => 'login'], function () {
    Route::post('/', 'StoreController')->name('auth.store');
});

// Для работы с категориями доходов
Route::group(['namespace' => 'App\Http\Controllers\CategoryIncomes', 'prefix' => 'category-incomes'], function () {
    Route::get('/', 'IndexController')->name('categoryIncomes.index');
});

// Для работы с категориями расходов
Route::group(['namespace' => 'App\Http\Controllers\CategoryExpenses', 'prefix' => 'category-expenses'], function () {
    Route::get('/', 'IndexController')->name('categoryExpenses.index');
});

// Для работы с доходами
Route::group(['namespace' => 'App\Http\Controllers\Income', 'prefix' => 'income'], function () {
    Route::get('/all', 'IndexController')->name('income.index');
    Route::post('/', 'StoreController')->name('income.store');
    Route::delete('/delete/{incomeId}', 'DeleteController')->name('income.delete');
});

// Для работы с расходами
Route::group(['namespace' => 'App\Http\Controllers\Expenses', 'prefix' => 'expenses'], function () {
    Route::get('/all', 'IndexController')->name('expenses.index');
    Route::post('/', 'StoreController')->name('expenses.store');
    Route::delete('/delete/{expenseId}', 'DeleteController')->name('expenses.delete');
});

// Экспорт файла
Route::group(['namespace' => 'App\Http\Controllers\ExportToExcel', 'prefix' => 'export'], function () {
    Route::get('/', 'IndexController')->name('export.index');
});
