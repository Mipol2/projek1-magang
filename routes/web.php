<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
    return view('auth.login');
});

Route::post('/switch-user', 'UserController@switchUser')->name('switch.user');

Route::get('welcome', [CustomerController::class, 'welcome'])->name('welcome');
Route::get('customer/force_delete/one/{id}', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');
Route::get('customer/restore/one/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
Route::get('restoreAll', [CustomerController::class, 'restoreAll'])->name('customers.restore.all');
Route::get('report/download', [ReportController::class, 'download'])->name('report.download');



Route::resource('report', ReportController::class);
Route::resource('customers', CustomerController::class);
Route::resource('pesanans', PesananController::class);
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');