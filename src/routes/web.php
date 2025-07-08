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

Route::get('news/create-test', function () {
    $news = new News();
    $news->title = 'Test news title2';
    $news->body = 'Test news body2';
   // $news->slug = 'wqeqwe';
    $news->save();
    return $news;
});

Route::get('news/{id}/hide', function ($id) {
    $news = News::findOrFail($id);
    $news->hidden = true;
    $news->save();
    // Вызовите событие NewsHidden.
    return 'News hidden';
});
