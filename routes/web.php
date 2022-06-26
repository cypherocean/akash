<?php

use Illuminate\Support\Facades\Route;

Route::get('command/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "config, cache, and view cleared successfully";
});

Route::get('command/config', function() {
    Artisan::call('config:cache');
    return "config cache successfully";
});

Route::get('command/key', function() {
    Artisan::call('key:generate');
    return "Key generate successfully";
});

Route::get('command/migrate', function() {
    Artisan::call('migrate:refresh');
    return "Database migration generated";
});

Route::get('seed', function() {
    Artisan::call('db:seed');
    return "Database seeding generated";
});

Route::group(['namespace' => 'Front'], function(){
    Route::get('/', 'RootController@index')->name('home');
    Route::get('portfolio/{id?}', 'RootController@portfolio')->name('portfolios');
    Route::post('contact', 'RootController@contact')->name('contact');
});

Route::group(['middleware' => ['prevent-back-history'], 'prefix' => 'admin', 'namespace' => 'admin'], function(){
    Route::group(['middleware' => ['guest:admin']], function () {
        Route::get('/', 'AuthController@login')->name('login');
        Route::post('signin', 'AuthController@signin')->name('signin');

        Route::get('forget-password', 'AuthController@forget_password')->name('forget.password');
        Route::post('password-forget', 'AuthController@password_forget')->name('password.forget');
        Route::get('reset-password/{string}', 'AuthController@reset_password')->name('reset.password');
        Route::post('recover-password', 'AuthController@recover_password')->name('recover.password');
    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Portfolio
            Route::any('portfolio', 'PortfolioController@index')->name('portfolio');
            Route::get('portfolio/create', 'PortfolioController@create')->name('portfolio.create');
            Route::post('portfolio/insert', 'PortfolioController@insert')->name('portfolio.insert');
            Route::get('portfolio/edit/{id?}', 'PortfolioController@edit')->name('portfolio.edit');
            Route::get('portfolio/view/{id?}', 'PortfolioController@view')->name('portfolio.view');
            Route::patch('portfolio/update', 'PortfolioController@update')->name('portfolio.update');
            Route::post('portfolio/change_status', 'PortfolioController@change_status')->name('portfolio.change_status');
            Route::post('portfolio/portfolio.profile.remove', 'PortfolioController@portfolio.profile.remove')->name('portfolio.profile.remove');
        // Portfolio

        /** settings */
            Route::get('settings', 'SettingsController@index')->name('settings');
            Route::post('settings/update', 'SettingsController@update')->name('settings.update');
            Route::post('settings/update/logo', 'SettingsController@logo_update')->name('settings.update.logo');
        /** settings */
    });
});