<?php

Route::group(['middleware' => ['api'], 'prefix' => 'api', 'as' => 'api.', 'namespace' => 'DesignByCode\Realtor\Http\Controllers\Api\Admin'], function () {

    Route::apiResource('properties', 'PropertiesController');

    Route::post('properties/{property}/upload', 'PropertiesImageController@upload')->name('properties.upload');
    Route::post('properties/{property}/uploadStore', 'PropertiesImageController@uploadStore')->name('properties.uploadStore');
    Route::delete('property/image/{property}', 'PropertiesImageController@delete_image')->name('properties.delete_image');
    Route::patch('media/{media}', 'PropertiesImageController@mediaUpdate')->name('properties.mediaUpdate');

    Route::get('userdata', 'AdminDataController@userData')->name('userdata');


});
