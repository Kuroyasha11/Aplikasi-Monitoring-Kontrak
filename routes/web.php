<?php

use App\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\HandlingController;
use App\Http\Controllers\ManagementWarehouseController;
use App\Http\Controllers\WarehouseController;

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
    return view('index', [
        'title' => 'Home',
        'judul' => 'Dashboard'
    ]);
})->middleware(['guest']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware(['auth']);
});

Route::get('/dashboard', function () {
    return view('index', [
        'title' => 'Home',
        'judul' => 'Dashboard'
    ]);
})->middleware(['auth']);

Route::resource('/dashboard/warehouse', WarehouseController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/management-warehouse', ManagementWarehouseController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/collateral-management-services', CMSController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/handling', HandlingController::class)->middleware(['auth'])->except(['show']);

Route::resource('/dashboard/contract', ContractController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/office', OfficeController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/depo-container', DepoController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/distribution', DistributionController::class)->middleware(['auth'])->except(['show']);
