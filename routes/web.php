<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SPPController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Middleware;

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


Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {


    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);
    

        /*Route Siswa*/
        Route::resource('admin', AdminController::class);
        /*Akhir Route Siswa*/

        /*Route Siswa*/
        Route::resource('siswa', StudentController::class);

        /*Route SPP*/
        Route::resource('spp', SPPController::class);
        /*Akhir Route SPP*/

        /*Route staff*/
        Route::resource('staff', StaffController::class);
        /*Akhir Route staff*/

        /*Route kelas*/
        Route::resource('kelas', KelasController::class);
        /*Akhir Route staff*/

        Route::get('pembayaran/report', [PembayaranController::class, 'report'])->name('Report');
        Route::put('pembayaran/show_report', [PembayaranController::class, 'show_report'])->name('Report');
    });
    
    Route::middleware(['staff'])->group(function () {
        Route::get('petugas', [StaffController::class, 'home']);
       
    });

    Route::middleware(['student'])->group(function () {
        Route::get('student', [StudentController::class, 'home']);
        Route::get('pembayaran/history', [PembayaranController::class, 'history'])->name('history');
    });

    Route::middleware(['role'])->group(function(){
        Route::get('pembayaran/studentPaymentHistory', [PembayaranController::class, 'paymentHistory'])->name('paymentHistory');
        Route::put('pembayaran/getPembayaran', [PembayaranController::class, 'getPembayaran'])->name('getPembayaran');
        Route::get('pembayaran/getsiswa/{id_kelas}', [PembayaranController::class, 'getSiswa'])->name('getSiswa');
        Route::get('pembayaran/getnisn/{id}', [PembayaranController::class, 'getNisn'])->name('getNisn');
        Route::resource('pembayaran', PembayaranController::class);
    });
    
});
