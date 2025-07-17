<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Mail\BookingCompletedMailing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('log-request')->group(function (){
    Route::get('log-ip', function (){
        return response()->json(['status' => 'succes']);
    });
});

Route::get('users', [UsersController::class, 'index']);
Route::get('users/{user}', [UsersController::class, 'show']);

Route::get('book', function () {
    $email = 'volkvania@yandex.ru';
    Mail::to($email)->send(new BookingCompletedMailing());
    return response()->json(['status' => 'succes']);
});

Route::get('test-telegram', function () {
    Telegram::sendMessage([
        'chat_id' => env('TELEGRAM_CHANNEL_ID'),
        'parse_mode' => 'html',
        'text'=> 'Произошло тестовое событие'
    ]);
    return response()->json(['status' => 'succes']);
});

Route::get('redirect', [AuthController::class, 'redirectToProvider']);
Route::get('callback', [AuthController::class, 'handleProviderCallback']);


// Route::get('/xdebug', function () {

//     $x=5;

//     echo xdebug_info();

// });



//Route::get('/hotels',[HotelController::class, 'index']);
