<?php

use App\Events\NewsCreated;
use App\Jobs\SyncNews;
use App\Models\News;
use App\Models\User;
use App\Notifications\UserEmailChangeNotification;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

Route::get('/sync-news', function(){
    SyncNews::dispatch(15);
    return response(['status' => 'success']);
});


Route::get('locale', function (){
    echo App::getLocale();
});

Route::get('locale/set/{locale}', function ($locale){
    App::setLocale($locale);
    echo App::getLocale();
    echo '<hr>';
    echo __('messages.greet');
});

Route::get('locale/{locale}/thanks', function ($locale, Request $request){
    App::setLocale($locale);
    echo __('messages.thanks', ['name'=>$request->input('name')]);
});


Route::get('user/create-test/{amount}', function($amount){
    return User::factory($amount)->create();
});

Route::get('user/{user}/change-email', function (User $user, Request $request){
    $oldEmail = $user->email;
    $user->email = $request->input('email');
    $user->save();
    $user->notify(new UserEmailChangeNotification($oldEmail));
    return response(['result' => 'email changed']);
});

Route::get('user/{user}/notifications', function (User $user){
    return $user->notifications;
});
