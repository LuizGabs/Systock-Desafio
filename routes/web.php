<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::post('/', [LoginUserController::class, 'authentication']);

Route::get('/signup', function () {
    return Inertia::render('Signup');
});

Route::post('/signup', [RegisterUserController::class, 'store']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
});