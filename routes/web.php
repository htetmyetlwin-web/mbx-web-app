<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::middleware('can:manage.users')->group(function(){
    Route::resource('/users', UserController::class, ['except' => ['show', 'create', 'store']]);
});
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/profile', [UserController::class, 'postProfile'])->name('user.postProfile');

Route::resource('permission', PermissionController::class);
// Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
// Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
// Route::get('/permission/create', [PermissionController::class, 'store'])->name('permission.store');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');