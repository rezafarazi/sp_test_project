<?php

use Illuminate\Support\Facades\Route;

//Login
Route::get('/', [\App\Http\Controllers\LoginController::class,'login']);
Route::post('/', [\App\Http\Controllers\LoginController::class,'logindone']);

//Signup
Route::get('/Signup', [\App\Http\Controllers\SignupController::class,'signup']);
Route::post('/Signup', [\App\Http\Controllers\SignupController::class,'signupdone']);

//Dashboard
Route::middleware(\App\Http\Middleware\UserLoginMiddleware::class)->group(function (){

    Route::get('/Dashboard', [\App\Http\Controllers\DashboardController::class,'dashboard']);

    Route::post('/NReport', [\App\Http\Controllers\ReportsController::class,'nreport']);
    Route::get('/Report/Check/{id}', [\App\Http\Controllers\ReportsController::class,'CheckReport']);

});

