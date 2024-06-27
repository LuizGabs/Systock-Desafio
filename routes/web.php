<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;

Route::get('/signup', function () {
    return Inertia::render('Signup');
});

Route::post('/signup', [RegisterUserController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });

    Route::get('/loggedUser', [LoginUserController::class, 'getAuthUser']);

    Route::get('/users', [UserController::class, 'listUsers']);

    Route::get('/newuser', function () {
        return Inertia::render('NewUser');
    });
    Route::post('/newuser', [RegisterUserController::class, 'store']);

    Route::get('/users/{user}/edit', [UserController::class, 'edit']);

    Route::get('/users/{user}/show', [UserController::class, 'show']);

    Route::put('/users/{user}', [UserController::class, 'update']);

    Route::get('/users/{user}/delete', [UserController::class, 'delete']); 

    Route::get('/logout', [UserController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::post('/', [LoginUserController::class, 'authentication']);
});
