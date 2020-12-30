<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    $title = 'Login';
    return view('login', compact('title'));
});

Route::post("/login", [UserController::class, 'login']);
Route::get("/dashboard", [UserController::class, 'dashboard']);
Route::get("/users", [UserController::class, 'users']);
Route::get("/sales_accounts", [UserController::class, 'salesAccounts']);
Route::get("/expenses", [UserController::class, 'expenses']);
Route::get("/logout", [UserController::class, 'logout']);
