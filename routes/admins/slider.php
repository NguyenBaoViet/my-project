<?php

Route::prefix('sliders')->group(function () {
    Route::get('/',[
        'as' => 'sliders.index',
        'uses' => 'AdminSliderController@index',
        'middleware' => 'can:list-slider'
    ]);
    Route::get('/create',[
        'as' => 'sliders.create',
        'uses' => 'AdminSliderController@create',
        'middleware' => 'can:add-slider'
    ]);
    Route::post('/store',[
        'as' => 'sliders.store',
        'uses' => 'AdminSliderController@store'
    ]);
    Route::get('/edit/{id}',[
        'as' => 'sliders.edit',
        'uses' => 'AdminSliderController@edit',
        'middleware' => 'can:edit-slider'
    ]);
    Route::post('/update/{id}',[
        'as' => 'sliders.update',
        'uses' => 'AdminSliderController@update'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'sliders.delete',
        'uses' => 'AdminSliderController@delete',
        'middleware' => 'can:delete-slider'
    ]);
});