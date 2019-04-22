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

// ------- Service Containter examples
// use Illuminate\Filesystem\Filesystem;

// app()->singleton('App\Twitter', function() {
// 	return new App\Twitter('theKey');
// });

// -------

use App\Notifications\SubscriptionRenewalFailed;

Route::get('/', function () {
	// 2) for testing Session
	// return session('name', 'a default'); //session()->forget('name') to delete 

	// 1) for setting session
	// session(['name' => 'JohnDoe']);

	// dd(app(Filesystem::class)); // Service Containter examples
    return view('welcome');

    // Testing Notifications
    $user = App\User::first();
    $user->notify(new SubscriptionRenewalFailed);
    return 'Done';
});

Route::resource('projects', 'ProjectsController')/*->middleware('can:update,project')*/;

// Route::get('/projects', 'ProjectsController@index');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::get('/projects/{project}', 'ProjectsController@destroy');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

Route::patch('/tasks/{task}', 'ProjectTasksController@update'); // or just TasksController@update, but 1st is more clear
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
