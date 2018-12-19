<?php

Route::group(
    [
        'middleware' => ['web'],
//        'middleware' => ['web', 'role:admin'],
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'DesignByCode\Realtor\Http\Controllers\Admin',
    ], function() {

       Route::get('/', 'AdminController@index')->name('index');


});
