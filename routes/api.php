<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

// Rotas CRUD para Users
Route::apiResource('users', UserController::class);

// Rotas CRUD para Tasks
Route::apiResource('tasks', TaskController::class);

Route::get('/teste', function () {
    return response()->json([
        'mensagem' => 'Olá, mundo!',
        'status' => 200
    ]);
});
