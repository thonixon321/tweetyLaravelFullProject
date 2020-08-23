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
Route::get('/profiles/{user:username}', 'ProfilesController@show')->name('profile');
Route::get('/tweets', 'TweetController@index')->name('home');
Route::post('/tweets', 'TweetController@store');
Route::delete('/tweets/{tweet}', 'TweetController@destroy')->name('deletetweet');
//couple ways to add authorization check, just like this with the grouping in the routes file, or in the controller construct method (tweets controller does this currently)
Route::middleware('auth')->group(function() {
    Route::post('/tweets/{tweet}/like', 'TweetLikeController@store');
    Route::delete('/tweets/{tweet}/like', 'TweetLikeController@destroy');
    Route::post('/profiles/{user:username}/follow', 'FollowsController@store')->name('follow');
    Route::get('/profiles/{user:username}/edit', 'ProfilesController@edit');
    Route::patch('/profiles/{user:username}', 'ProfilesController@update');
    Route::get('/explore', 'ExploreController'); //don't need @index here cause we have __invoke 
});