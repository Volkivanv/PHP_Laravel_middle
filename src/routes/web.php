<?php

use App\Events\NewsCreated;
use App\Models\News;
use Illuminate\Support\Facades\Route;

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
    NewsCreated::dispatch(News::first());
    return view('welcome');
});

Route::get('/logs', function () {
    return view('logs');
});

Route::get('/news-update-test', function () {
    News::withoutEvents(function () {
        News::first()->update(['title' => 'TestNew']);
    });
    return 'updated';
});
