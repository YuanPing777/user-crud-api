<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn () => redirect()->route('users.index'));

Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('create', 'create')->name('create');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::get('{user}', 'show')->name('show');
    Route::put('{user}', 'update')->name('update'); 
    Route::delete('{user}', 'destroy')->name('destroy');
    Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
});
