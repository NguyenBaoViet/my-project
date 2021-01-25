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

    //User
    Route::prefix('users')->group(function () {
        Route::get('/',[
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
        ]);
        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
        ]);
        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete'
        ]);
    });

    //Role
    Route::prefix('roles')->group(function () {
        Route::get('/',[
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index'
        ]);
        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create'
        ]);
        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'roles.delete',
            'uses' => 'AdminRoleController@delete'
        ]);
    });

    //Permission
    Route::prefix('permissions')->group(function () {
        Route::get('/create',[
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@create'
        ]);
        Route::post('/store',[
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
    });
});