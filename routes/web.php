<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PesananController;
use App\Models\Customer;

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

Route::get('/welcome', function () {
    return view('welcome');
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


