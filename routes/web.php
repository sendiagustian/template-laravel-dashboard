<?php

use Illuminate\Support\Facades\Route;

Route::get("/", \App\Livewire\Welcome::class)->name('welcome');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Dashboard\Index::class)->name('dashboard');
    Route::get('/admin/users', \App\Livewire\User\Index::class)->name('users');
});
