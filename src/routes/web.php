<?php

Route::group(
    [
        'middleware' => ['web'],
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'DesignByCode\Realtor\Http\Controllers\Admin',
    ], function() {

       Route::get('/', 'AdminController@index')->name('index');


});
