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


Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);
        Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
        Route::post('register', [AuthController::class, 'register']);

        // /*route admin */
        // Route::get('staff', [AdminController::class, 'index']);
        // /*Akhir route petugas*/

         /*Route Siswa*/
         Route::resource('admin', AdminController::class);
         /*Akhir Route Siswa*/

        /*Route Siswa*/
        Route::resource('siswa', StudentController::class);
       
        /*Akhir Route Siswa*/

        /*Route pembayaran*/
        Route::resource('pembayaran', PembayaranController::class);
        Route::get('pembayaran/getsiswa/{id_kelas}', [PembayaranController::class, 'getSiswa'])->name('getSiswa');
        Route::get('pembayaran/getnisn/{id}', [PembayaranController::class, 'getNisn'])->name('getNisn');

        
        /*Akhir Route Siswa*/

        /*Route SPP*/
        Route::resource('spp', SPPController::class);
        /*Akhir Route SPP*/

        /*Route staff*/
        Route::resource('staff', StaffController::class);
        /*Akhir Route staff*/

        /*Route kelas*/
        Route::resource('kelas', KelasController::class);
        /*Akhir Route staff*/
    });
    Route::middleware(['staff'])->group(function () {
    });

    Route::middleware(['student'])->group(function () {
    });
});
