<?php

use Illuminate\Support\Facades\Route;

Route::get("/", \App\Livewire\Landing\Welcome::class)->name('welcome');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'acl:superadmin,admin,editor'])->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard\Index::class)->name('admin.dashboard');
});

Route::middleware(['auth', 'acl:superadmin, admin'])->group(function () {
    Route::get('/admin/profile', \App\Livewire\Admin\Profile::class)->name('admin.profile');

    Route::get('/admin/users', \App\Livewire\Admin\User\Index::class)->name('admin.users');
    Route::get('/admin/users/create', \App\Livewire\Admin\User\Create::class)->name('admin.users.create');
    Route::get('/admin/users/edit', \App\Livewire\Admin\User\Edit::class)->name('admin.users.edit');
    Route::delete('/admin/users/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.users.delete');

    Route::get('/admin/roles', \App\Livewire\Admin\Role\Index::class)->name('admin.roles');
    Route::get('/admin/roles/create', \App\Livewire\Admin\Role\Create::class)->name('admin.roles.create');
    Route::get('/admin/roles/edit', \App\Livewire\Admin\Role\Edit::class)->name('admin.roles.edit');
    Route::delete('/admin/roles/delete/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('admin.roles.delete');

    Route::get('/admin/menus', \App\Livewire\Admin\Menu\Index::class)->name('admin.menus');
});

Route::middleware(['auth', 'acl:admin'])->group(function () {

});

Route::middleware(['auth', 'acl:editor'])->group(function () {

});

Route::middleware(['auth', 'acl:user'])->group(function () {

});