<?php

use App\Http\Controllers\cms\AuthController;
use App\Http\Controllers\cms\CategoryController;
use App\Http\Controllers\cms\CountryController;
use App\Http\Controllers\cms\NavigationController;
use App\Http\Controllers\cms\PaymentController;
use App\Http\Controllers\cms\UserAccessController;
use App\Http\Controllers\cms\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// auth

Route::get('/administrator/login', [AuthController::class, 'index'])->name('login');
Route::post('/administrator/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/administrator/register', [AuthController::class, 'register'])->name('register');
Route::post('/administrator/register', [AuthController::class, 'store'])->name('auth.register');



Route::middleware(['auth', 'access'])->group(function () {

    Route::get('/administrator', function () {
        $title = "Dashboard";
        return view('cms.pages.dashboard.index', compact('title'));
    })->name('cms.dashboard');

    // navigation
    Route::get('/administrator/navigation', [NavigationController::class, 'index'])->name('cms.navigation');
    Route::get('/administrator/navigation/{id}', [NavigationController::class, 'changeStatus'])->name('cms.navigation.status');
    Route::post('/administrator/navigation', [NavigationController::class, 'store'])->name('cms.navigation.store');
    Route::patch('/administrator/navigation/update', [NavigationController::class, 'update'])->name('cms.navigation.update');
    Route::delete('/administrator/navigation/delete', [NavigationController::class, 'destroy'])->name('cms.navigation.delete');


    // user
    Route::get('/administrator/user', [UserController::class, 'index'])->name('cms.user');
    Route::get('/administrator/user/{id}', [UserController::class, 'changeStatus'])->name('cms.user.status');
    Route::post('/administrator/user', [UserController::class, 'store'])->name('cms.user.store');
    Route::patch('/administrator/user', [UserController::class, 'update'])->name('cms.user.update');
    Route::delete('/administrator/user', [UserController::class, 'destroy'])->name('cms.user.delete');


    // user-access
    Route::get('/administrator/user-access', [UserAccessController::class, 'index'])->name('cms.user-access');
    Route::post('/administrator/user-access', [UserAccessController::class, 'store'])->name('cms.user-access.store');
    Route::patch('/administrator/user-access', [UserAccessController::class, 'update'])->name('cms.user-access.update');
    Route::delete('/administrator/user-access', [UserAccessController::class, 'destroy'])->name('cms.user-access.delete');

    Route::get('/administrator/user-access/{id}', [UserAccessController::class, 'access'])->name('cms.user-access.access');
    Route::post('/administrator/user-access/checked', [UserAccessController::class, 'checked'])->name('cms.user-access.checked');


    Route::get('/administrator/logout', [AuthController::class, 'logout'])->name('logout');
});
