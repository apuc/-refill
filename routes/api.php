<?php

use Illuminate\Http\Request;


Route::post('/login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'Api\AuthController@logout');

    Route::get('providers', 'CellProviderController@index');
    Route::get('replenish/{id}', 'UserBalanceController@show');
    Route::post('replenish/{id}', 'UserBalanceController@store');
});
