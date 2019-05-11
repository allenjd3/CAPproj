<?php

use Illuminate\Http\Request;

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

Route::get('/module/{id}', 'ModuleController@show');
Route::get('/survey/{id}', 'SurveyController@show');
Route::post('/survey/', 'SurveyController@store');
Route::get('/survey/', 'SurveyController@index');
Route::post('/module/', 'ModuleController@store');
Route::put('/module/{id}', 'ModuleController@update');
Route::put('/survey/{id}', 'SurveyController@update');

