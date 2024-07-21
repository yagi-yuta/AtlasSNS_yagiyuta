<?php
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
  Route::get('/search', 'UsersController@search')->name('search');
  Route::get('/follow-list', 'FollowsController@followList')->name('follow-list');
  Route::get('/follower-list', 'FollowsController@followerList')->name('follower-list');
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
