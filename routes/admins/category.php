<?php
 Route::prefix('categories')->group(function () {
    Route::get('/',[
        'as' => 'category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:list-category'
    ]);
    Route::get('/create',[
        'as' => 'category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:add-category'
    ]);
    Route::post('/store',[
        'as' => 'category.store',
        'uses' => 'CategoryController@store'
    ]);
    Route::get('/edit/{id}',[
        'as' => 'category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:edit-category'
    ]);
    Route::post('/update/{id}',[
        'as' => 'category.update',
        'uses' => 'CategoryController@update'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'category.delete',
        'uses' => 'CategoryController@delete',
        'middleware' => 'can:delete-category'
    ]);
});