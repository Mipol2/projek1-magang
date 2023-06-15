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

Route::get('/', function () {
    return view('welcome');
});


Route::get('customer/force_delete/one/{id}', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');
Route::get('customer/restore/one/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
Route::get('restoreAll', [CustomerController::class, 'restoreAll'])->name('customers.restore.all');
Route::match(['get', 'post'], '/customers/{id}/upload', [CustomerController::class, 'upload'])->name('customers.upload');
Route::post('customers/{id}/upload', [CustomerController::class, 'upload'])->name('customers.upload'); // Add this line
Route::get('customers/hapus/{id}',[CustomerController::class, 'destroy']);
Route::post('customers/{customer}', [CustomerController::class, 'update']);
Route::post('/customers/{id}/upload-image', [CustomerController::class, 'storeImage'])->name('customers.uploadImage');
Route::get('pesanans/hapus/{id}',[PesananController::class, 'destroy']);
Route::post('pesanans/{pesanan}', [PesananController::class, 'update']);
Route::get('report/download', [ReportController::class, 'download'])->name('report.download');


Route::resource('customers', CustomerController::class);
Route::resource('report', ReportController::class);
Route::resource('pesanans', PesananController::class);
