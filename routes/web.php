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

Route::get('/', function () {
	// dd(app(Filesystem::class)); // Service Containter examples
    return view('welcome');
});

Route::resource('projects', 'ProjectsController');

// Route::get('/projects', 'ProjectsController@index');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::get('/projects/{project}', 'ProjectsController@destroy');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

Route::patch('/tasks/{task}', 'ProjectTasksController@update'); // or just TasksController@update, but 1st is more clear