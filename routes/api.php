<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\GradeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('user/login', [LoginController::class, 'userLogin'])->name('userLogin');
// Route::group(['prefix' => 'user', 'middleware' => ['auth:user', 'scopes:user']], function () {
//     // authenticated staff routes here
//     Route::get('dashboard', [LoginController::class, 'userDashboard']);
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/posts',
        [PostController::class, 'index']
    );

    Route::get(
        '/grades',
        [GradeController::class, 'index']
    );
});

// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['auth:jwt.api'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     // Add more routes that require authentication here
//     // For example:
// });