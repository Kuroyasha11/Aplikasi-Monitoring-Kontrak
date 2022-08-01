<?php

use App\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\MailController;

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
    return view('welcome', [
        'title' => 'Home',
        'judul' => 'Landing Page'
    ]);
})->middleware(['guest']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware(['auth']);
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware(['auth']);
    Route::get('/dashboard/contract/print', 'print')->middleware(['auth', 'admin']);
});

Route::get('/send-mail', [MailController::class, 'index']);

Route::resource('/dashboard/contract', ContractController::class)->middleware(['auth', 'admin'])->except(['edit']);
Route::controller(ContractController::class)->group(function () {
    Route::put('/dashboard/contract/selesai/{selesai}', 'selesai')->middleware(['auth', 'admin']);
});
// Route::resource('/dashboard/service', ServiceController::class)->middleware(['auth', 'admin'])->only(['index']);
Route::resource('/dashboard/warehouse', WarehouseController::class)->middleware(['auth', 'admin'])->except(['show', 'create', 'edit']);
Route::resource('/dashboard/depo', DepoController::class)->middleware(['auth', 'admin'])->except(['show', 'create', 'edit']);
Route::resource('/dashboard/cms', CMSController::class)->middleware(['auth', 'admin'])->except(['show', 'create', 'edit']);
Route::resource('/dashboard/logistic', LogisticController::class)->middleware(['auth', 'admin'])->except(['show', 'create', 'edit']);
