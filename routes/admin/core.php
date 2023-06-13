<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Core Routes
|--------------------------------------------------------------------------
|
| Here is where you can register core related routes for your application.
|
*/

Route::controller(UtilityController::class)->middleware('can:view_transaction')->prefix('fungsi')->name('transaction.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('get-data', 'getData')->name('getdata');
    Route::post('create', 'createData')->name('create');
    Route::post('{id}/update', 'updateData')->name('update');
    Route::delete('{id}/delete', 'deleteData')->name('delete');
});

Route::controller(ReportController::class)->middleware('can:view_report')->prefix('report')->name('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('get-data', 'getData')->name('getdata');
});