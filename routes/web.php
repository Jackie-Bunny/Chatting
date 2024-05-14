<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ChatController;

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
    return view('login');
})->name('login.get');

// chat view
Route::get('/messenger', [ChatController::class, 'chatGet'])->name('chat.get');

// auth
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

// get user
Route::post('/users', [ChatController::class, 'userGet'])->name('user.get');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message.post');
Route::post('/get-messages', [ChatController::class, 'getMessages'])->name('get.messages');

// fetch messages 5 secs
Route::post('/fetch-messages', [ChatController::class, 'fetchMessages'])->name('fetch-messages.post');