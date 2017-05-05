<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/under-construction', 'UnderConstruction\UnderConstructionController@index');
    Route::get('/under-construction/login', 'UnderConstruction\UnderConstructionController@login');
    Route::post('/under-construction/login', 'UnderConstruction\UnderConstructionController@authenticate');
    Route::get('/under-construction/logout', 'UnderConstruction\UnderConstructionController@logout');
});