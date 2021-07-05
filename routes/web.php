<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\FrontController;
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

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/post', [FrontController::class, 'post']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);




Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('categories', CategoryController::class);

Route::resource('posts', PostController::class);

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
//     Route::get('/create', [FrontController::class, 'index']);
//     Route::get('/lists', [FrontController::class, 'index']);
//     Route::get('/dashbord', [FrontController::class, 'index']);
//     Route::get('/users/1', [FrontController::class, 'index']);
// });