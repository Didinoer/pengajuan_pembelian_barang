<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\financeController;
use App\Http\Controllers\managerController;
use App\Http\Controllers\officerController;
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
//login
Route::get('/login', [authController::class, 'login'] )-> name('login')-> middleware('guest');
Route::post('/login', [authController::class, 'authenticating']);
//logout
Route::get('/logout', [authController::class , 'logout'] ) ->middleware('auth');

//home
Route::get('/home', function (){
    return view('/home');
})->middleware('auth');


//officer
Route::get('/input-pengajuan-barang', [officerController::class, 'formajuan'] )-> 
middleware(['auth','officer']);
Route::post('/prosesformajuan', [officerController::class, 'prosesformajuan'])-> middleware(['auth','officer']);
Route::get('/list-pengajuan', [officerController::class, 'listpengajuan'] )-> 
middleware(['auth','officer']);

//manager
Route::get('/list-pengajuan-officer', [managerController::class, 'listpengajuanofficer'] )-> 
middleware(['auth','manager']);
Route::post('/prosesmanager', [managerController::class, 'prosesmanager'])-> middleware(['auth','manager']);
Route::get('/detailfotomanager/{id}', [managerController::class, 'detailfotomanager'])-> middleware(['auth','manager',]);

//finance
Route::get('/list-pengajuan-manager', [financeController::class, 'listpengajuanmanager'] )-> 
middleware(['auth','finance']);
Route::post('/prosesfinance', [financeController::class, 'prosesfinance'])-> middleware(['auth','finance']);
Route::get('/uploadbuktitransferfinance/{id}', [financeController::class, 'uploadbuktitransferfinance'])-> middleware(['auth','finance']);
Route::put('uploadbuktitransferfinance/uploadbuktitransferfinanceproses/{id}', [financeController::class, 'uploadbuktitransferfinanceproses'])-> middleware(['auth','finance']);
Route::get('/detailfotofinance/{id}', [financeController::class, 'detailfotofinance'])-> middleware(['auth','finance',]);


