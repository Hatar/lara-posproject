<?php
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

            Route::get('/','WelcomeController@index')->name('welcome');

            //Route categories
            Route::resource('/categories','CategoryController')->except('show');

            //Route Products
            Route::resource('/products','ProductController')->except('show');

            //Route Clients
            Route::resource('/clients','ClientController')->except('show');
            Route::resource('/clients.orders','Client\OrderController')->except('show');

            //Route Order
            Route::resource('/orders','OrderController');

            //Route users
            Route::resource('/users','UserController')->except('show');

        });
    });