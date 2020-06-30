<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register','AuthController@register');
    Route::post('me', 'AuthController@me');
});

//Resources
Route::resource('clients','ClientController');
Route::resource('employees','EmployeeController');

//orphan routes
Route::get('clients/{column}/like/{value}','ClientController@indexLike');
Route::get('occupations','OccupationController@index');
Route::get('economicActivities','EconomicActivityController@index');

Route::group([
    'prefix' => 'auth'
],function($router){
    Route::get('/users','UserController@index');
    Route::get('/users/{id}','UserController@show');
    Route::put('/users/activate/{id}','UserController@activate');
    Route::put('/users/deactivate/{id}','UserController@deactivate');
    Route::put('/users/{id}','UserController@update');
    Route::delete('/users/{id}','UserController@destroy');
});

