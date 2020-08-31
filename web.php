<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
 'uses' => 'PublicationController@index',
 'as' => 'home',
 'middlware' => 'auth'
]);



/* ===================== Concerning Friends Request And Users Search ========================*/



/*Search*/ 
Route::get('/search', 'SearchController@getResults')->name('search.results');

/*User profile*/
Route::get('/user{id}', 'ProfileController@getProfile')->name('profile.index');

/*Friends*/
Route::group([
    'middleware' => 'auth'
  ], function() {
      Route::get('/friends', 'FriendController@getIndex')->name('friends.index');
  });

  Route::group([
    'middleware' => 'auth'
  ], function() {
      Route::get('/friends/add/{id}', 'FriendController@getAdd')->name('friends.add');
  });

  Route::group([
    'middleware' => 'auth'
  ], function() {
      Route::get('/friends/accept{id}', 'FriendController@getAccept')->name('friends.accept');
  });

  Route::group([
    'middleware' => 'auth'
  ], function() {
      Route::post('/friends/delete/{id}', 'FriendController@postDelete')->name('friends.delete');
  });


/* ===================== ============================================= ========================*/






