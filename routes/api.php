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

Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::get('user-data', 'LoginController@getAuthenticatedUser');

    /*CONTROL DE ROLES*/
    Route::apiResource('apiRoles', 'Administrador\ApiRoles');
    Route::apiResource('apiUsuarios', 'Administrador\ApiUsuarios');
    Route::apiResource('apiPermisos', 'Administrador\ApiPermisos');



});


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('registro', 'LoginController@register');
    Route::post('login', 'LoginController@authenticate');
});
