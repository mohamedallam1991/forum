<?php

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
// Route::get('factory', function () {
//     $threads = factory('App\Thread', 50)->create();

//     return $threads->each(function ($thread) {
//         factory('App\Reply', 10)->create(['thread_id' => $thread->id ]);
//     });
// });
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('threads', 'ThreadsController');
Route::get('/threads', 'ThreadsController@index');

Route::get('/threads/create', 'ThreadsController@create');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::post('/threads', 'ThreadsController@store');
Route::get('/threads/{channel}', 'ThreadsController@index');

Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
