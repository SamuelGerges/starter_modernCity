<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::namespace('Api\User')->group(function(){
    // out of middleware
    // TODO:: URL OF USER

    Route::post('store_user','UserController@RegisterUser')->name('StoreUser');
    Route::post('login_user','UserController@LoginUser')->name('LoginUser');


    // i n middleware
    Route::middleware('userToken:api_user')->group(function(){
        Route::post('show_favorite','FavoriteController@ShowFavorite');
        Route::post('add_to_favorite','FavoriteController@AddToFavorite');
        Route::post('delete_from_favorite','FavoriteController@DeleteFromFavorite');
    });
});


Route::group(['namespace' => 'Api\Craftsman'], function(){

    // TODO:: URL OF Craftsman
    Route::post('store_crafts','CraftsmanController@RegisterCraftsman')->name('StoreCraftsman');
    Route::post('login','CraftsmanController@LoginCraftsman')
        ->name('LoginCraftsman');
});

