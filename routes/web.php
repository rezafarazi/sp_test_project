<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\LoginController::class,'login']);
Route::post('/', [\App\Http\Controllers\LoginController::class,'logindone']);


Route::get('/Signup', [\App\Http\Controllers\SignupController::class,'signup']);
Route::post('/Signup', [\App\Http\Controllers\SignupController::class,'signupdone']);
