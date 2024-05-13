<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('home');


Route::get('/users', [UserController::class,'index'])->name('users');

Route::get('/posts', [PostController::class,'index'])->name('post.index');
Route::get('/posts/add', [PostController::class,'create'])->name('post.create');
Route::post('/posts/add', [PostController::class,'store'])->name('post.store');
Route::get('/posts/{post}', [PostController::class,'show'])->name('post.show');

Route::get('/news', [NewsController::class,'index'])->name('news.index');
Route::get('/news/add', [NewsController::class,'create'])->name('news.create');
Route::post('/news/add', [NewsController::class,'store'])->name('news.store');
Route::get('/news/{news}', [NewsController::class,'show'])->name('news.show');

Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
Route::get('/categories/add', [CategoryController::class,'create'])->name('categories.create');
Route::post('/categories/add', [CategoryController::class,'store'])->name('categories.store');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//Login Route
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


