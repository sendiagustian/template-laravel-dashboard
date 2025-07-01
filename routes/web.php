<?php

use Illuminate\Support\Facades\Route;

Route::get("/", \App\Livewire\Landing\Welcome::class)->name('welcome');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard\Index::class)->name('admin.dashboard');
    Route::get('/admin/profile', \App\Livewire\Admin\Profile::class)->name('admin.profile');
    Route::get('/admin/users', \App\Livewire\Admin\User\Index::class)->name('admin.users');
    Route::get('/admin/menus', \App\Livewire\Admin\Menu\Index::class)->name('admin.menus');
    Route::get('/admin/roles', \App\Livewire\Admin\Role\Index::class)->name('admin.roles');
});
