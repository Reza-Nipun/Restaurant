<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TableController;

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

Route::get('/forgot_password', function () {
    $title = 'Forgot Password';
    return view('forgot_password', compact('title'));
});

Route::post("/login", [UserController::class, 'login']);
Route::post("/registration", [RegistrationController::class, 'registration']);
Route::post("/user_availability", [RegistrationController::class, 'userAvailability']);
Route::post("/forgot_password_accessability", [RegistrationController::class, 'forgotPasswordAccessability']);
Route::post("/send_reset_password_link", [RegistrationController::class, 'sendResetPasswordLink']);
Route::get("/reset_my_password/{email}/{code}", [RegistrationController::class, 'resetMyPassword']);
Route::post("/resetting_password/{email}/{code}", [RegistrationController::class, 'resettingPassword']);

Route::get("/dashboard", [UserController::class, 'dashboard']);
Route::get("/registration_requests", [UserController::class, 'registrationRequests']);
Route::get("/users", [UserController::class, 'users']);
Route::get("/new_user", [UserController::class, 'newUser']);
Route::post("/save_new_user", [UserController::class, 'saveNewUser']);
Route::get("/reset_password/{id}", [UserController::class, 'resetPassword']);
Route::get("/sales_accounts", [UserController::class, 'salesAccounts']);
Route::get("/edit_sales_account/{id}", [UserController::class, 'editSalesAccount']);
Route::post("/update_sales_account/{id}", [UserController::class, 'updateSalesAccount']);
Route::get("/create_sales_account", [UserController::class, 'createSalesAccount']);
Route::post("/save_sales_account", [UserController::class, 'saveSalesAccount']);
Route::get("/edit_registration_request/{id}", [UserController::class, 'editRegistrationRequest']);
Route::get("/edit_user/{id}", [UserController::class, 'editUser']);
Route::post("/update_user/{id}", [UserController::class, 'updateUser']);
Route::post("/update_registration_info/{id}", [UserController::class, 'updateRegistrationInfo']);
Route::get("/profile", [UserController::class, 'getProfileInfo']);
Route::post("/update_user_profile/{id}", [UserController::class, 'updateUserProfile']);

Route::get("/expenses", [ExpenseController::class, 'expenses']);
Route::get("/create_expense", [ExpenseController::class, 'createExpense']);
Route::post("/save_expense", [ExpenseController::class, 'saveExpense']);
Route::get("/edit_expense/{id}", [ExpenseController::class, 'editExpense']);
Route::post("/update_expense/{id}", [ExpenseController::class, 'updateExpense']);
Route::get("/delete_expense/{id}", [ExpenseController::class, 'deleteExpense']);

Route::get("/products", [ProductController::class, 'productList']);
Route::get("/create_product", [ProductController::class, 'createProduct']);
Route::post("/save_product", [ProductController::class, 'saveProduct']);
Route::get("/edit_product/{id}", [ProductController::class, 'editProduct']);
Route::post("/update_product/{id}", [ProductController::class, 'updateProduct']);

Route::get("/categories", [CategoryController::class, 'categoryList']);
Route::get("/create_category", [CategoryController::class, 'createCategory']);
Route::post("/save_category", [CategoryController::class, 'saveCategory']);
Route::get("/edit_category/{id}", [CategoryController::class, 'editCategory']);
Route::post("/update_category/{id}", [CategoryController::class, 'updateCategory']);

Route::get("/tables", [TableController::class, 'index']);
Route::get("/create_table", [TableController::class, 'createTable']);
Route::post("/save_table", [TableController::class, 'saveTable']);

Route::get("/pending_sell_list", [SaleController::class, 'pendingSellList']);
Route::get("/print/{invoice_id}", [SaleController::class, 'printOrder']);
Route::get("/print_invoice/{invoice_id}", [SaleController::class, 'printInvoice']);
Route::get("/sale_product", [SaleController::class, 'saleProduct']);
Route::post("/save_sale_product", [SaleController::class, 'saveSaleProduct']);
Route::get("/edit_order/{invoice_id}", [SaleController::class, 'editOrder']);
Route::post("/update_sale_product", [SaleController::class, 'udpateSaleProduct']);
Route::get("/reconcile_order", [SaleController::class, 'reconcileOrder']);
Route::post("/allow_reconciliation", [SaleController::class, 'allowReconciliation']);

Route::get("/logout", [UserController::class, 'logout']);
