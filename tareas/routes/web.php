<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/inicio', fn () => redirect()->route('tareas.index'))->name('inicio');

    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});