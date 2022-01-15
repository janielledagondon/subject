<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
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

//auth route for all 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::resource('/dashboard/showsubjects', 'App\Http\Controllers\SubjectController@viewall'); //view all subjects
});

// for guests
Route::group(['middleware' => ['auth', 'role:guest|admin|incharge']], function() { 
    Route::get('/dashboard/showsubjects', 'App\Http\Controllers\DashboardController@showsubjects')->name('dashboard.showsubjects');
    
});

// for incharge
Route::group(['middleware' => ['auth', 'role:incharge|admin']], function() {
    Route::get('/dashboard/manage', 'App\Http\Controllers\DashboardController@manage')->name('dashboard.manage');
    //Route::resource('/dashboard/manage', 'App\Http\Controllers\SubjectController@create');
    //Route::resource('/dashboard/manage', 'App\Http\Controllers\SubjectController@edit');
    //Route::resource('/dashboard/manage', 'App\Http\Controllers\SubjectController@create');
});


require __DIR__.'/auth.php';
