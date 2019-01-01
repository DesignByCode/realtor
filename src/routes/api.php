<?php




Route::group(/**
 *  api routes
 */
    ['middleware' => ['api'], 'prefix' => 'api', 'as' => 'api.', 'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Admin'], function () {


    Route::apiResource('properties', 'PropertiesController');
    Route::patch('properties/price/{property}', 'PricesController@update')->name('price.update');
    Route::patch('properties/features/{property}', 'FeaturesController@update')->name('features.update');
    Route::apiResource('profile', 'ProfileController');
    Route::post('properties/{property}/upload', 'PropertiesImageController@upload')->name('properties.upload');
    Route::post('properties/{property}/uploadStore', 'PropertiesImageController@uploadStore')->name('properties.uploadStore');
    Route::delete('property/image/{property}', 'PropertiesImageController@delete_image')->name('properties.delete_image');
    Route::patch('media/{media}', 'PropertiesImageController@mediaUpdate')->name('properties.mediaUpdate');
    Route::get('userdata', 'AdminDataController@userData')->name('userdata');

    Route::apiResource('tags', 'TagsController');

    Route::post('password', 'PasswordController@store')->name('password.update');
    Route::post('phones', 'PhoneController@store')->name('phones.added');
    Route::delete('phones/{phone}', 'PhoneController@destroy')->name('phones.remove');


    Route::delete('remove_user/{property}/{user}', 'PropertyUsersController@destroy')->name('remove_user.remove');

});


Route::group(/**
 *  api for datatables
 */
    ['middleware' => ['api'], 'prefix' => 'api/datatables', 'as' => 'api.datatables.', 'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables'], function () {

    Route::resource('users', 'UsersController');
    Route::resource('properties', 'PropertiesController');

});


Route::group(/**
 *  routes for auth
 */
    [
    'middleware' => 'api',
    'prefix' => 'api/auth',
    'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Admin'

], function () {

    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');

    Route::post('/logout', 'AuthController@logout');
    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::get('/me', 'AuthController@user');
    });

});


Route::group(
    [
        'as' => 'api.fronted.',
        'prefix' => 'api/fronted',
        'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Frontend',
        'middleware' => ['web']
    ],
    function(){
    Route::resource('properties', 'PropertiesController');
});
