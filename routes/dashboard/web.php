<?php
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
            Route::get('/index','DashboardController@index')->name('index');

            //Route users
            Route::resource('/users','UserController')->except('show');

            //Route categories
            Route::resource('/categories','CategoryController')->except('show');
        });
    });