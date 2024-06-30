<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PolyController;
use App\Http\Controllers\QueueController;

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('users')->group(function () {
        // doctor resource
        Route::resource('dokter', DoctorController::class);

        // nurse resource
        Route::resource('perawat', NurseController::class);

    });

    Route::middleware('isAdmin')->group(function () {
        // user resource
        Route::resource('user', UserController::class);


        // poly resource
        Route::resource('poli', PolyController::class);
    });


    // admin, nurse, doctor middleware
    Route::middleware('AdminDoctorNurse')->group(function () {
        // patient resource
        Route::resource('pasien', PatientController::class);

    });

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');
});
