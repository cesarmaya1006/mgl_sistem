<?php

use App\Http\Controllers\Seguridad\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [LoginController::class, 'login_api'])->name('login_api');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

