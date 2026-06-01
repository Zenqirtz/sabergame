<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/device', function () {
    return view('device');
});
Route::get('/listgame', function () {
    return view('listgame');
});
// Halaman chatbot (UI) → dimuat di iframe modal pada Home
Route::get('/chatbot', function () {
    return view('chatbot');
});
Route::get('/nav', function () {
    return view('nav');
});

// Endpoint AJAX untuk mengirim pesan user dan menerima balasan AI
Route::post('/chat', [ChatController::class, 'chat']);
