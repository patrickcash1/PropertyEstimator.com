<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ImageController;
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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('add-worker', ['as' => 'pages.addworker', 'uses' => 'App\Http\Controllers\RegistrationController@create']);
	Route::get('workers-list', ['as' => 'pages.workerslist', 'uses' => 'App\Http\Controllers\PageController@workerslist']);
	Route::get('tasks-list', ['as' => 'pages.taskslist', 'uses' => 'App\Http\Controllers\PageController@taskslist']);
	Route::get('assign-task', ['as' => 'pages.assigntask', 'uses' => 'App\Http\Controllers\PageController@assigntask']);
	Route::get('add-measurement', ['as' => 'pages.addmeasurement', 'uses' => 'App\Http\Controllers\PageController@addmeasurement']);
	Route::get('/view-task/{id}', ['as' => 'pages.viewtask', 'uses' => 'App\Http\Controllers\PageController@viewtask']);
	Route::get('measurements-list', ['as' => 'pages.measurementslist', 'uses' => 'App\Http\Controllers\PageController@measurementslist']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::post('store-worker', 'App\Http\Controllers\RegistrationController@store');
	Route::post('save-task', 'App\Http\Controllers\PostController@storetask');
	Route::post('save-property', 'App\Http\Controllers\PostController@storeproperty');
	Route::post('temporary-upload', [ImageController::class, 'temporaryUpload'])->name('temporaryUpload');
});

Auth::routes();
