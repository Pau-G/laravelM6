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

Route::get('getPeople', [App\Http\Controllers\APIController::class, 'getPeopleFromDB']);

Route::get('getApiPeople', [App\Http\Controllers\APIController::class, 'getPeopleFromApi']);
