<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/under-construction', 'Jrl05k\UnderConstruction\UnderConstructionController@index');
    Route::get('/under-construction/login', 'Jrl05k\UnderConstruction\UnderConstructionController@login');
    Route::post('/under-construction/login', 'Jrl05k\UnderConstruction\UnderConstructionController@authenticate');
    Route::get('/under-construction/logout', 'Jrl05k\UnderConstruction\UnderConstructionController@logout');
});