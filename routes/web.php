<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/register', function () {
    $title = 'Register';
    return view('register', compact('title'));
});

Route::post("/login", [UserController::class, 'login']);
Route::post("/registration", [RegistrationController::class, 'registration']);
Route::post("/user_availability", [RegistrationController::class, 'userAvailability']);
Route::get("/dashboard", [UserController::class, 'dashboard']);
Route::get("/registration_requests", [UserController::class, 'registrationRequests']);
Route::get("/users", [UserController::class, 'users']);
Route::get("/sales_accounts", [UserController::class, 'salesAccounts']);
Route::get("/expenses", [UserController::class, 'expenses']);
Route::get("/edit_registration_request/{id}", [UserController::class, 'editRegistrationRequest']);
Route::get("/edit_user/{id}", [UserController::class, 'editUser']);
Route::post("/update_user/{id}", [UserController::class, 'updateUser']);
Route::post("/update_registration_info/{id}", [UserController::class, 'updateRegistrationInfo']);
Route::get("/logout", [UserController::class, 'logout']);
