<?php

Route::group(['middleware' => ['web', 'api'], 'prefix' => 'api', 'as' => 'api.', 'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Admin'], function () {

    Route::apiResource('properties', 'PropertiesController');

    Route::post('properties/{property}/upload', 'PropertiesController@upload')->name('properties.upload');
    Route::post('properties/{property}/uploadStore', 'PropertiesController@uploadStore')->name('properties.uploadStore');
    Route::delete('property/image/{property}', 'PropertiesController@delete_image')->name('properties.delete_image');

    Route::get('userdata', 'AdminDataController@userData')->name('userdata');


});
