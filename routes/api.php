<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\MessageController;
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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    // Route::get('/posts',
    //     [PostController::class, 'index']
    // );

    Route::apiResource(
        '/grades',
        GradeController::class
    );
});

// Route::get('conversations',[ConversationController::class,'index']);
// Route::get('conversations/{id}/messages', [MessageController::class, 'index']);
// Route::post('messsages',[MessageController::class,'store']);
// Route::delete('messages/{id}/', [MessageController::class, 'destroy']);

// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['auth:jwt.api'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     // Add more routes that require authentication here
//     // For example:
// });