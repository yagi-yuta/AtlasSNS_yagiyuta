<?php

use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added')->name('added');
//ログイン中のページ
//0715ミドルウェア追記
Route::middleware(['auth'])->group(function () {
  Route::get('/top', 'PostsController@index')->name('top');
  Route::get('/profile', 'UsersController@profile')->name('profile');
  Route::post('/profile/edit', 'UsersController@editProfile')->name('profile.edit');
  Route::get('/search', 'UsersController@search')->name('search');
  Route::post('/search', 'UsersController@search')->name('search.post');
  Route::get('/follow-list', 'FollowsController@followList')->name('follow-list');
  Route::get('/follower-list', 'FollowsController@followerList')->name('follower-list');
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
  Route::post('/post', 'PostsController@store');
  Route::delete('/post/{id}', 'PostsController@destroy')->name('posts.destroy');
  Route::get('/post/{id}/edit', 'PostsController@edit')->name('posts.edit');
  Route::post('/post/{id}', 'PostsController@update')->name('posts.update');
  //フォロー　フォロー解除処理
  Route::post('/remove_follow/{id}', 'FollowsController@remove_follow')->name('remove_follow');
  Route::post('/follow/{id}', 'FollowsController@follow')->name('follow');
  //フォローリスト処理
  Route::get('/users/profile/{id}', 'UsersController@followProfile')->name('user.profile');
  //ユーザープロフィール
});
