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
Route::get('/fiLoadDashboard/{from?}/{to?}')->name('fiLoadDashboard')->uses('FinanceController@fiLoadDashboard');
Route::post('/fiLoadDashboard/{from?}/{to?}')->name('fiLoadDashboard')->uses('FinanceController@fiLoadDashboard');

Route::get('/fiMainSetting')->name('mainSetting')->uses('FinanceController@fiMainSetting');
Route::post('/fiMainSetting')->name('mainSetting')->uses('FinanceController@fiMainSetting');
Route::post('/fiEditMainSetting')->name('editMainSetting')->uses('FinanceController@fiEditMainSetting');

Route::get('/fiBudget')->name('budget')->uses('FinanceController@fiBudget');
Route::post('/fiBudgetInsert')->name('budgetInsert')->uses('FinanceController@fiBudgetInsert');

Route::get('/fiInputSpend/{tab?}')->name('inputSpend')->uses('FinanceController@fiInputSpend');
Route::post('/fiInputSpendExe')->name('inputSpendExe')->uses('FinanceController@fiInputSpendExe');
Route::post('/fiInputIncomeExe')->name('fiInputIncomeExe')->uses('FinanceController@fiInputIncomeExe');
Route::post('/fiInputSavingExe')->name('inputSavingExe')->uses('FinanceController@fiInputSavingExe');

Route::get('/fiSpendData')->name('spendData')->uses('FinanceController@fiSpendData');
Route::get('/fiGetSpendData')->name('getSpendData')->uses('FinanceController@fiGetSpendData');
Route::post('/fiGetSpendData')->name('getSpendData')->uses('FinanceController@fiGetSpendData');

Route::get('/fiSavingData')->name('savingData')->uses('FinanceController@fiSavingData');
Route::get('/fiGetSavingData')->name('getSavingData')->uses('FinanceController@fiGetSavingData');
Route::post('/fiGetSavingData')->name('getSavingData')->uses('FinanceController@fiGetSavingData');

Route::get('/fiIncomeData')->name('incomeData')->uses('FinanceController@fiIncomeData');
Route::get('/fiGetIncomeData')->name('getIncomeData')->uses('FinanceController@fiGetIncomeData');
Route::post('/fiGetIncomeData')->name('getIncomeData')->uses('FinanceController@fiGetIncomeData');


// Route::get('/custData')->name('custData')->uses('CustomerController@custData');
// Route::get('/getCustData')->name('getCustData')->uses('CustomerController@getCustData');

// Route::get('/garduIndukData')->name('garduIndukData')->uses('MasterController@garduIndukData');

Auth::routes([
    'register' => true,
    'verify' => true,
    'reset' => true,
]);
