<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GoodPurchaseController;
use App\Http\Controllers\GoodSaleController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('loginForm');
})->name('index');

Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password-page', [AuthController::class, 'forgetPass'])->name('forgetPasswordPage');
Route::get('forget-password', [AuthController::class, 'forgetPassPage'])->name('forgetPasswordFunction');
Route::get('password-update-page', [AuthController::class, 'passUpdatePage'])->name('passwordUpdatePage')->middleware('web');
Route::post('password-update', [AuthController::class, 'updatePassword'])->name('passwordUpdate');

Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('', [DashboardController::class, 'dashboard'])->name('dashboard');

    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('profile')->group(function () {
        Route::get('detail', [AuthController::class, 'profile'])->name('profile');
        Route::post('update', [AuthController::class, 'updateProfile'])->name('updateProfile');
        Route::get('password-management', [AuthController::class, 'psmanage'])->name('passwordManagement');
    });

    //-------------- admin routes --------------
    Route::get('list', [AdminController::class, 'list'])->name('adminLists');
    Route::get('create', [AdminController::class, 'create'])->name('adminCreate');
    Route::post('store', [AdminController::class, 'store'])->name('adminStore');
    Route::post('manage-admin', [AdminController::class, 'manageAdmin'])->name('manageAdmin');
    Route::get('profile', [AdminController::class, 'profile'])->name('adminProfile');
    Route::group(['prefix' => '{admin_id}', 'where' => ['admin_id' => '[0-9]+'], 'middleware' => ['adminIsValidResource:admin']], function () {
        Route::get('edit', [AdminController::class, 'edit'])->name('adminEdit');
        Route::patch('update', [AdminController::class, 'update'])->name('adminUpdate');
    });
});
