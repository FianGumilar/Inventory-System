<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UtilityController;

/*
|--------------------------------------------------------------------------
| Core Routes
|--------------------------------------------------------------------------
|
| Here is where you can register core related routes for your application.
|
*/

Route::controller(UtilityController::class)->middleware('can:view_utility')->prefix('fungsi')->name('utility.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('get-data', 'getData')->name('getdata');
    Route::post('create', 'createData')->name('create');
    Route::post('{id}/update', 'updateData')->name('update');
    Route::delete('{id}/delete', 'deleteData')->name('delete');
});