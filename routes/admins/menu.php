<?php

Route::prefix('menus')->group(function () {
    Route::get('/',[
        'as' => 'menus.index',
        'uses' => 'MenuController@index',
        'middleware' => 'can:list-menu'
    ]);
    Route::get('/create',[
        'as' => 'menus.create',
        'uses' => 'MenuController@create',
        'middleware' => 'can:add-menu'
    ]);
    Route::post('/store',[
        'as' => 'menus.store',
        'uses' => 'MenuController@store'
    ]);
    Route::get('/edit/{id}',[
        'as' => 'menus.edit',
        'uses' => 'MenuController@edit',
        'middleware' => 'can:edit-menu'
    ]);
    Route::post('/update/{id}',[
        'as' => 'menus.update',
        'uses' => 'MenuController@update'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'menus.delete',
        'uses' => 'MenuController@delete',
        'middleware' => 'can:delete-menu'
    ]);
});