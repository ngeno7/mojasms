<?php

use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Route;
use Moja\Moja;

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

Route::get('/', [
    SMSController::class, 'index'
])->name('home');
Route::post('/send-sms', [
    SMSController::class, 'sendSMS'
])->name('send-sms');
