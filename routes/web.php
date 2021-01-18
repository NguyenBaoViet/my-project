<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/adm', 'AdminController@loginAdmin');
Route::post('/adm', 'AdminController@postLoginAdmin');
    
Route::get('/home', function () {
    return view('home');
});

Route::prefix('adm')->group(function () {
    //Category
    Route::prefix('categories')->group(function () {
        Route::get('/',[
            'as' => 'category.index',
            'uses' => 'CategoryController@index'
        ]);
        Route::get('/create',[
            'as' => 'category.create',
            'uses' => 'CategoryController@create'
        ]);
        Route::post('/store',[
            'as' => 'category.store',
            'uses' => 'CategoryController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'category.edit',
            'uses' => 'CategoryController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'category.update',
            'uses' => 'CategoryController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'category.delete',
            'uses' => 'CategoryController@delete'
        ]);
    });

    //Menu
    Route::prefix('menus')->group(function () {
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);
        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });

    //Product
    Route::prefix('products')->group(function () {
        Route::get('/',[
            'as' => 'products.index',
            'uses' => 'AdminProductController@index'
        ]);
        Route::get('/create',[
            'as' => 'products.create',
            'uses' => 'AdminProductController@create'
        ]);
        Route::post('/store',[
            'as' => 'products.store',
            'uses' => 'AdminProductController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'products.edit',
            'uses' => 'AdminProductController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'products.update',
            'uses' => 'AdminProductController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'products.delete',
            'uses' => 'AdminProductController@delete'
        ]);
    });

    //Slider
    Route::prefix('sliders')->group(function () {
        Route::get('/',[
            'as' => 'sliders.index',
            'uses' => 'AdminSliderController@index'
        ]);
        Route::get('/create',[
            'as' => 'sliders.create',
            'uses' => 'AdminSliderController@create'
        ]);
        Route::post('/store',[
            'as' => 'sliders.store',
            'uses' => 'AdminSliderController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'sliders.edit',
            'uses' => 'AdminSliderController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'sliders.update',
            'uses' => 'AdminSliderController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'sliders.delete',
            'uses' => 'AdminSliderController@delete'
        ]);
    });

    //Setting
    Route::prefix('settings')->group(function () {
        Route::get('/',[
            'as' => 'settings.index',
            'uses' => 'AdminSettingController@index'
        ]);
        Route::get('/create',[
            'as' => 'settings.create',
            'uses' => 'AdminSettingController@create'
        ]);
        Route::post('/store',[
            'as' => 'settings.store',
            'uses' => 'AdminSettingController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'settings.edit',
            'uses' => 'AdminSettingController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'settings.update',
            'uses' => 'AdminSettingController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'settings.delete',
            'uses' => 'AdminSettingController@delete'
        ]);
    });
});