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

Route::group(['middleware' => 'auth:api'], function() {
    //Resources
    Route::resource('clients','ClientController');
    Route::resource('employees','EmployeeController');
    Route::resource('permissions','PermissionController');
    Route::resource('roles','RoleController');
    Route::resource('insurances','InsuranceController');
    Route::resource('branches','BranchController');
    Route::resource('policies','PoliciesController');
    Route::resource('sinisters','SinisterController');

    //1.orphan routes
    Route::get('clients/{column}/like/{value}','ClientController@indexLike');
    Route::post('clients/filterby/{column}','ClientController@filterBy');
    Route::put('clients/{client}/activate','ClientController@activate');
    Route::put('clients/{client}/deactivate','ClientController@deactivate');
    Route::get('clients/list/all','ClientController@list');
    Route::get('occupations','OccupationController@index');
    Route::get('economicActivities','EconomicActivityController@index');
    Route::get('files/{client}','FileController@index');
    Route::get('positions','PositionController@index');
    Route::get('branches/main/get','BranchController@main');
    Route::get('insurances/list/all','InsuranceController@list');
    Route::post('branches/{insurance_id}/commission','BranchController@addInsuranceCommission');
    Route::get('branches/commission/{commission_id}','BranchController@getInsuranceCommission');
    Route::delete('branches/commission/{commission_id}','BranchController@removeInsuranceCommission');
    Route::put('branches/commission/{commission_id}','BranchController@updateInsuranceCommission');
    Route::get('insurances/{id}/branches','InsuranceController@getBranches');
    Route::get('employees/user/{id}','EmployeeController@getEmployeeByUser');
    Route::get('statistics','StatisticsController@index');
    Route::delete('files/{id}   ','FileController@delete');


    //1.1Roles
    Route::post('roles/{role}/permission/{permission}','RoleController@givePermissionToRole');
    Route::delete('roles/{role}/permission/{permission}','RoleController@revokePermissionToRole');

    //Lists


    Route::get('lists/{type}','ListsController@main');
   // Route::get('lists/brands','ListsController@brands');
    //Route::get('lists/models','ListsController@models');
    //Route::get('lists/banks','ListsController@banks');
    //Route::get('lists/vehicleTypes','ListsController@vehicleTypes');
    //Route::get('lists/planTypes','ListsController@planTypes');

    //Branchs details
    Route::post('policies/branch/cars/detail','CarBranchPolicyDetailController@cars');
});




Route::group([
    'prefix' => 'auth','middleware' => 'auth:api'
],function($router){
    Route::get('/users','UserController@index');
    Route::get('/users/{id}','UserController@show');
    Route::put('/users/activate/{id}','UserController@activate');
    Route::put('/users/deactivate/{id}','UserController@deactivate');
    Route::put('/users/{id}','UserController@update');
    Route::delete('/users/{id}','UserController@destroy');

    Route::post('/users/{user}/role/{role}','UserController@addUserToRole');
    Route::delete('/users/{user}/role/{role}','UserController@removeUserFromRole');

});


//DEVELOPMENT ROUTES OUT FROM API MIDDLEWARE

Route::post('payments','PaymentsController@create');
Route::get('payments','PaymentsController@getPolicyPayments');
Route::get('/payments/{policy}/upcoming','PaymentsController@getUpcomingPaymentsToBeDue');

