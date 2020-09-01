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
Route::get('/fiInputSpend')->name('inputSpend')->uses('FinanceController@fiInputSpend');
Route::post('/fiInputSpendExe')->name('inputSpendExe')->uses('FinanceController@fiInputSpendExe');
Route::get('/fiSpendData')->name('spendData')->uses('FinanceController@fiSpendData');
Route::get('/fiGetSpendData')->name('getSpendData')->uses('FinanceController@fiGetSpendData');
// Route::get('/custData')->name('custData')->uses('CustomerController@custData');
// Route::get('/getCustData')->name('getCustData')->uses('CustomerController@getCustData');

// Route::get('/garduIndukData')->name('garduIndukData')->uses('MasterController@garduIndukData');

Auth::routes([
    'register' => true,
    'verify' => true,
    'reset' => true,
]);
