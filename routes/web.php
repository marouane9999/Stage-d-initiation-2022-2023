<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return to_route('dashboard.index');
});

Auth::routes();

Route::group(['prefix' => '/participants'], function () {
    Route::get('/', [App\Http\Controllers\ParticipantController::class, 'index'])->name('participants.index');
    Route::get('/create', [App\Http\Controllers\ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/store', [App\Http\Controllers\ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/edit/{id}', [App\Http\Controllers\ParticipantController::class, 'edit'])->name('participants.edit');
    Route::post('/update/{id}', [App\Http\Controllers\ParticipantController::class, 'update'])->name('participants.update');
    Route::get('/show/{id}', [App\Http\Controllers\ParticipantController::class, 'show'])->name('participants.show');
    Route::get('/delete/{id}', [App\Http\Controllers\ParticipantController::class, 'destroy'])->name('participants.delete');
});
Route::group(['prefix' => '/vols'], function () {
    Route::get('/', [App\Http\Controllers\VolController::class, 'index'])->name('vols.index');
    Route::get('/create', [App\Http\Controllers\VolController::class, 'create'])->name('vols.create');
    Route::post('/store', [App\Http\Controllers\VolController::class, 'store'])->name('vols.store');
    Route::get('/edit/{id}', [App\Http\Controllers\VolController::class, 'edit'])->name('vols.edit');
    Route::post('/update/{id}', [App\Http\Controllers\VolController::class, 'update'])->name('vols.update');
    Route::get('/show/{id}', [App\Http\Controllers\VolController::class, 'show'])->name('vols.show');
    Route::get('/delete/{id}', [App\Http\Controllers\VolController::class, 'delete'])->name('vols.delete');
    Route::get('/reporting', [App\Http\Controllers\ReportingVolController::class, 'index'])->name('vols.reporting');
});

Route::group(['prefix' => '/hebergements'], function () {
    Route::get('/', [App\Http\Controllers\HebergementController::class, 'index'])->name('hebergements.index');
    Route::get('/create', [App\Http\Controllers\HebergementController::class, 'create'])->name('hebergements.create');
    Route::post('/store', [App\Http\Controllers\HebergementController::class, 'store'])->name('hebergements.store');
    Route::get('/edit/{id}', [App\Http\Controllers\HebergementController::class, 'edit'])->name('hebergements.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HebergementController::class, 'update'])->name('hebergements.update');
    Route::get('/show/{id}', [App\Http\Controllers\HebergementController::class, 'show'])->name('hebergements.show');
    Route::get('/delete/{id}', [App\Http\Controllers\HebergementController::class, 'delete'])->name('hebergements.delete');
    Route::get('/reporting', [App\Http\Controllers\HebergementReportingController::class, 'index'])->name('hebergements.reporting');

});
Route::group(['prefix' => '/restaurations'], function () {
    Route::get('/', [App\Http\Controllers\RestaurationController::class, 'index'])->name('restaurations.index');
    Route::get('/create', [App\Http\Controllers\RestaurationController::class, 'create'])->name('restaurations.create');
    Route::post('/store', [App\Http\Controllers\RestaurationController::class, 'store'])->name('restaurations.store');
    Route::get('/edit/{id}', [App\Http\Controllers\RestaurationController::class, 'edit'])->name('restaurations.edit');
    Route::post('/update/{id}', [App\Http\Controllers\RestaurationController::class, 'update'])->name('restaurations.update');
    Route::get('/delete/{id}', [App\Http\Controllers\RestaurationController::class, 'delete'])->name('restaurations.delete');
    Route::get('/show/{id}', [App\Http\Controllers\RestaurationController::class, 'show'])->name('restaurations.show');
    Route::get('/reporting', [App\Http\Controllers\RestaurationReportingController::class, 'index'])->name('restaurations.reporting');
});

Route::group(['prefix' => '/volontaires'], function () {
    Route::get('/', [App\Http\Controllers\VolontaireController::class, 'index'])->name('volontaires.index');
    Route::get('/create', [App\Http\Controllers\VolontaireController::class, 'create'])->name('volontaires.create');
    Route::post('/store', [App\Http\Controllers\VolontaireController::class, 'store'])->name('volontaires.store');
    Route::get('/edit/{id}', [App\Http\Controllers\VolontaireController::class, 'edit'])->name('volontaires.edit');
    Route::post('/update/{id}', [App\Http\Controllers\VolontaireController::class, 'update'])->name('volontaires.update');
    Route::get('/delete/{id}', [App\Http\Controllers\VolontaireController::class, 'delete'])->name('volontaires.delete');
    Route::get('/show/{id}', [App\Http\Controllers\VolontaireController::class, 'show'])->name('volontaires.show');
    Route::get('/reporting', [App\Http\Controllers\VolontaireReportingController::class, 'index'])->name('volontaires.reporting');

});

Route::group(['prefix' => '/dashboard'], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

