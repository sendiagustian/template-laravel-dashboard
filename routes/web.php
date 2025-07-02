<?php

use Illuminate\Support\Facades\Route;

Route::get("/", \App\Livewire\Landing\Welcome::class)->name('welcome');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard\Index::class)
        ->middleware('acl:superadmin,admin,editor')
        ->name('dashboard');

    // Dapat diakses oleh: superadmin, admin
    Route::get('/profile', \App\Livewire\Admin\Profile::class)
        ->middleware(middleware: 'acl:superadmin,admin')
        ->name(name: 'profile');

    Route::middleware('acl:superadmin,admin')->group(function () {
        Route::get('/users', \App\Livewire\Admin\User\Index::class)->name('users');
        Route::get('/users/create', \App\Livewire\Admin\User\Create::class)->name('users.create');
        Route::get('/users/edit', \App\Livewire\Admin\User\Edit::class)->name('users.edit');
        Route::delete('/users/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete');
    });

    Route::middleware('acl:superadmin')->group(function () {
        // Routes untuk Roles
        Route::get('/roles', \App\Livewire\Admin\Role\Index::class)->name('roles');
        Route::get('/roles/create', \App\Livewire\Admin\Role\Create::class)->name('roles.create');
        Route::get('/roles/edit', \App\Livewire\Admin\Role\Edit::class)->name('roles.edit');
        Route::delete('/roles/delete/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('roles.delete');

        // Routes untuk Menus
        Route::get('/menus', \App\Livewire\Admin\Menu\Index::class)->name('menus');
        Route::get('/menus/create', \App\Livewire\Admin\Menu\Create::class)->name('menus.create');
        Route::get('/menus/edit', \App\Livewire\Admin\Menu\Edit::class)->name('menus.edit');
        Route::delete('/menus/delete/{id}', [\App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menus.delete');
    });
});

Route::middleware(['auth', 'acl:user'])->group(function () {

});