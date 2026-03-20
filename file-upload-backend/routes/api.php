<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::resource('user', UserController::class);
Route::get('/get-all', [UserController::class, 'getAll']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
