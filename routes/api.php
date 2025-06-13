<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::prefix('users')->name('api.users.')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('{id}', 'show')->name('show');
    Route::delete('{id}', 'destroy')->name('destroy');
    Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
});