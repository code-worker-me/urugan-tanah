<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserManagementController::class, 'index'])->name('user-manage.index');
    Route::get('/user/create', [UserManagementController::class, 'create'])->name('user-manage.create');
    Route::post('/user/store', [UserManagementController::class, 'store'])->name('user-manage.store');
    Route::delete('/user/delete/{user}', [UserManagementController::class, 'delete'])->name('user-manage.delete');
});
