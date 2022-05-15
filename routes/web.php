<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
//Route login-logout
Route::prefix('homes')->group(function () {
    Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('homes.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('homes.logout');
});
//Route middleware-auth
Route::middleware('auth')->group(function () {
    //Route change-password
    Route::get('/change-password', [LoginController::class, 'showFormChangePassword'])->name('homes.showFormChangePassword');
    Route::post('/change-password', [LoginController::class, 'changePassword'])->name('homes.changePassword');
    //Route profile-view
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    //Route list-user
    Route::get('/users/list', [UserController::class, 'index'])->name('users.index')->middleware('check-permission:' . config('const.ROLE.MANAGER'));
    //Route check first-login && check-role
    Route::middleware('check-permission')->group(function () {
        //Route departments
        Route::resource('departments', 'DepartmentController')->except(['edit', 'suakhoa', 'destroy']);
        Route::get('{id}/sua', [DepartmentController::class, 'edit'])->name('departments.sua');
        Route::post('{id}/suakhoa', [DepartmentController::class, 'update'])->name('departments.suakhoa');
        Route::get('{id}/xoa', [DepartmentController::class, 'destroy'])->name('departments.destroy');
        //Route classes
        Route::resource('classes', 'ClassesController')->except(['edit', 'update', 'destroy']);
        Route::get('{id}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
        Route::post('{id}/update', [ClassesController::class, 'update'])->name('classes.update');
        Route::get('{id}/xoalop', [ClassesController::class, 'destroy'])->name('classes.destroy');

        //Route Schedule
        Route::resource('schedule', 'ScheduleController')->except(['edit', 'destroy']);
        Route::get('{id}/delete', [ScheduleController::class, 'destroy'])->name('schedules.delete');

        //Route users
        Route::resource('users', 'UserController')->except(['index']);
        //Route profile
        Route::prefix('profiles')->group(function () {
            Route::get('/{id}/update-profile', [UserController::class, 'showFormUpdateProfile'])->name('profiles.showFormUpdateProfile');
            Route::post('/{id}/update-profile', [UserController::class, 'updateProfile'])->name('profiles.updateProfile');
        });
        //Route reset-password
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
        //Export data
        Route::get('/export', [UserController::class, 'export'])->name('export');
    });
    });
