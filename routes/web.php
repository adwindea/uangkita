<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/')->name('dashboard')->uses('FinanceController@index');
Route::get('/fiMainSetting')->name('mainSetting')->uses('FinanceController@fiMainSetting');
Route::post('/fiMainSetting')->name('mainSetting')->uses('FinanceController@fiMainSetting');
Route::post('/fiEditMainSetting')->name('editMainSetting')->uses('FinanceController@fiEditMainSetting');

Route::get('/fiBudget')->name('budget')->uses('FinanceController@fiBudget');
Route::post('/fiBudgetInsert')->name('budgetInsert')->uses('FinanceController@fiBudgetInsert');

Route::get('/fiInputSpend/{tab?}')->name('inputSpend')->uses('FinanceController@fiInputSpend');
Route::post('/fiInputSpendExe')->name('inputSpendExe')->uses('FinanceController@fiInputSpendExe');
Route::get('/fiSpendData')->name('spendData')->uses('FinanceController@fiSpendData');
Route::get('/fiGetSpendData')->name('getSpendData')->uses('FinanceController@fiGetSpendData');
Route::post('/fiGetSpendData')->name('getSpendData')->uses('FinanceController@fiGetSpendData');
Route::get('/fiLoadDashboard/{from?}/{to?}')->name('fiLoadDashboard')->uses('FinanceController@fiLoadDashboard');
Route::post('/fiLoadDashboard/{from?}/{to?}')->name('fiLoadDashboard')->uses('FinanceController@fiLoadDashboard');

Route::post('/fiInputIncomeExe')->name('fiInputIncomeExe')->uses('FinanceController@fiInputIncomeExe');
Route::post('/fiInputSavingExe')->name('inputSavingExe')->uses('FinanceController@fiInputSavingExe');


// Route::get('/custData')->name('custData')->uses('CustomerController@custData');
// Route::get('/getCustData')->name('getCustData')->uses('CustomerController@getCustData');

// Route::get('/garduIndukData')->name('garduIndukData')->uses('MasterController@garduIndukData');

Auth::routes([
    'register' => true,
    'verify' => true,
    'reset' => true,
]);
