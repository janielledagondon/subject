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

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

// for guests
Route::group(['middleware' => ['auth', 'role:guest|admin|incharge']], function() { 
    Route::get('/dashboard/showsubjects', 'App\Http\Controllers\DashboardController@showsubjects')->name('dashboard.showsubjects');
});

// for incharge
Route::group(['middleware' => ['auth', 'role:incharge|admin']], function() {
    Route::get('/dashboard/manage', 'App\Http\Controllers\DashboardController@manage')->name('dashboard.manage');
});


require __DIR__.'/auth.php';
