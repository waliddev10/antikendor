<?php

use App\Http\Controllers\DataPkbHitamController;
use App\Http\Controllers\DataPkbPerusahaanController;
use App\Http\Controllers\Pengaturan\UserController;
use Illuminate\Support\Facades\Artisan;
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

// setup

Route::get('/migrate', function () {
    return Artisan::call('migrate');
});
Route::get('/migrate/fresh', function () {
    return Artisan::call('migrate:fresh');
});
Route::get('/seed', function () {
    return Artisan::call('db:seed');
});
Route::get('/symlink', function () {
    $target =  env('SYMLINK_PATH');
    $shortcut = env('SYMLINK_PATH_TARGET');
    return symlink($target, $shortcut);
});

// router


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });
    Route::get('/dashboard', function () {
        return redirect()->route('data_pkb_hitam.index');
    })->name('dashboard.index');


    Route::resource('/data_pkb_hitam', DataPkbHitamController::class);
    Route::get('/upload/data_pkb_hitam', [DataPkbHitamController::class, 'upload'])->name('data_pkb_hitam.upload');
    Route::post('/import/data_pkb_hitam', [DataPkbHitamController::class, 'import'])->name('data_pkb_hitam.import');

    Route::resource('/data_pkb_perusahaan', DataPkbPerusahaanController::class);
    Route::get('/upload/data_pkb_perusahaan', [DataPkbPerusahaanController::class, 'upload'])->name('data_pkb_perusahaan.upload');
    Route::post('/import/data_pkb_perusahaan', [DataPkbPerusahaanController::class, 'import'])->name('data_pkb_perusahaan.import');


    Route::prefix('/pengaturan')->middleware('role:admin')->group(function () {
        Route::resource('/user', UserController::class)->except('show');
    });
});

require __DIR__ . '/auth.php';
