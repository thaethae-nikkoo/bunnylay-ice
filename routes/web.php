<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PaymentMethodController;
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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
    Route::prefix('profile')->group(function () {
        Route::get('detail', [AuthController::class, 'profile'])->name('profile');
        Route::post('update', [AuthController::class, 'updateProfile'])->name('updateProfile');
        Route::get('password-management', [AuthController::class, 'psmanage'])->name('passwordManagement');
    });
});

Route::middleware(['superAdmin'])->group(function () {
    //-------------- machine routes --------------
    Route::prefix('machines')->name('machines.')->group(function () {
        Route::get('', [MachineController::class, 'index'])->name('index');
        Route::post('', [MachineController::class, 'store'])->name('store');
        Route::get('{id}/edit', [MachineController::class, 'edit'])->name('edit');
        Route::patch('{id}', [MachineController::class, 'update'])->name('update');
        Route::post('{id}/delete', [MachineController::class, 'destroy'])->name('destroy');
        Route::post('{id}/status', [MachineController::class, 'updateStatus'])->name('status');
    });

    //-------------- admin routes --------------
    Route::prefix('admin')->group(function () {
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

    //-------------- payment methods routes --------------
    Route::prefix('payment_methods')->name('payment_method.')->group(function () {
        Route::get('list', [PaymentMethodController::class, 'list'])->name('list');
        Route::post('create', [PaymentMethodController::class, 'create'])->name('create');
        Route::group(['prefix' => '{payment_method_id}', 'where' => ['payment_method_id' => '[0-9]+'], 'middleware' => ['adminIsValidResource:payment_method']], function () {
            Route::patch('update', [PaymentMethodController::class, 'update'])->name('update');
            Route::post('change-status', [PaymentMethodController::class, 'changeStatus'])->name('changeStatus');
            Route::post('delete', [PaymentMethodController::class, 'delete'])->name('delete');
        });
    });

    //------------ Description Routes ----------------
    Route::prefix('description-groups')->name('description_gps.')->group(function () {
        Route::get('list', [DescriptionController::class, 'gpList'])->name('list');
        Route::post('create', [DescriptionController::class, 'gpcreate'])->name('create');
        Route::group(['prefix' => '{description_gp_id}', 'where' => ['description_gp_id' => '[0-9]+'], 'middleware' => ['adminIsValidResource:description_gp']], function () {
            Route::post('delete', [DescriptionController::class, 'gpDelete'])->name('delete');
            Route::patch('update', [DescriptionController::class, 'gpUpdate'])->name('update');
            Route::prefix('descriptions')->name('descriptions.')->group(function () {
                Route::get('list', [DescriptionController::class, 'descriptionList'])->name('list');
                Route::post('create', [DescriptionController::class, 'createDescription'])->name('create');
                Route::group(['prefix' => '{description_id}', 'where' => ['description_id' => '[0-9]+'], 'middleware' => ['adminIsValidResource:description']], function () {
                    Route::patch('update', [DescriptionController::class, 'updateDescription'])->name('update');
                    Route::post('delete', [DescriptionController::class, 'deleteDescription'])->name('delete');
                });
            });
        });
    });

});
