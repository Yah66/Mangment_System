<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\LoginRegisterController;


use App\Http\Livewire\Dashboard\Grade;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('auth/callback/google', [GoogleController::class, 'callbackToGoogle']);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
        Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
        Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
        Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
        Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');

        Route::get('/send_emails', [SendMailController::class, 'form'])->name('send_mails.form');
        Route::post('/send', [SendMailController::class, 'send'])->name('send_mails');
        Route::post('/test', [SendMailController::class, 'testMail'])->name('test_mails');



        Route::middleware(['auth'])->group(function () {
            Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
            Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
            Route::patch('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');
            Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
            Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
            Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
            Route::patch('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
            Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

            Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
            Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
            Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
            Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
        });
    }
);