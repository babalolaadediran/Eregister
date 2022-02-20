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

# admin route grouping
Route::group(['admin' => 'admin'], function () {
    
    # admin home
    Route::get('administrator/home', 'AdminController@home');

    # admin profile
    Route::get('administrator/profile', 'AdminController@profile');

    # update profile
    Route::post('administrator/update/profile', 'AdminController@updateProfile');

    # update password
    Route::post('administrator/update/password', 'AdminController@updatePassword');

    # registrar registration page
    Route::get('administrator/registrars', 'AdminController@newRegistrarPage');

    # register registrar
    Route::post('administrator/registrars', 'AdminController@newRegistrar');

    # edit registrar
    Route::get('administrator/registrar/edit/{id}', 'AdminController@editRegistrar');

    # update registrar
    Route::post('administrator/registrar/edit/{id}', 'AdminController@updateRegistrar');

    # delete registrar
    Route::delete('administrator/delete/registrar', 'AdminController@deleteRegistrar');

    # register immigrant page
    Route::get('administrator/register/immigrant', 'AdminController@newImmigrantPage');

    # register new immigrant
    Route::post('administrator/register/immigrant', 'AdminController@newImmigrant');

    # manage immigrants page
    Route::get('administrator/immigrants', 'AdminController@manageImmigrantsPage');

    # edit immigrant
    Route::get('administrator/immigrant/edit/{id}', 'AdminController@editImmigrant');

    # update immigrant
    Route::post('administrator/immigrant/edit/{id}', 'AdminController@updateImmigrant');

    # delete immigrant
    Route::delete('administrator/delete/immigrant', 'AdminController@deleteImmigrant');

    # country report page
    Route::get('administrator/report/countries', 'AdminController@countryReport');

    # print overall country report
    Route::get('administrator/print/overall/report', 'AdminController@printGeneralCountryReport');

    # print report page
    Route::get('administrator/report/print', 'AdminController@printReportPage');

    # print report 
    Route::post('administrator/report/printing', 'AdminController@initiatePrinting');

    # logout
    Route::get('administrator/logout', 'AdminController@logout');
});

# registrar route grouping
Route::group(['registrar' => 'registrar'], function () {

    # registrar home
    Route::get('registrar/home', 'RegistrarController@home');

    # registrar profile
    Route::get('registrar/profile', 'RegistrarController@profile');

    # update profile
    Route::post('registrar/update/profile', 'RegistrarController@updateProfile');

    # update password
    Route::post('registrar/update/password', 'RegistrarController@updatePassword');

    # register immigrant page
    Route::get('registrar/register/immigrant', 'RegistrarController@newImmigrantPage');

    # register immigrant
    Route::post('registrar/register/immigrant', 'RegistrarController@newImmigrant');

    # manage immigrants page
    Route::get('registrar/immigrants', 'RegistrarController@manageImmigrantsPage');

    # edit immigrant
    Route::get('registrar/immigrant/edit/{id}', 'RegistrarController@editImmigrant');

    # update immigrant
    Route::post('registrar/immigrant/edit/{id}', 'RegistrarController@updateImmigrant');

    # delete immigrant
    Route::delete('registrar/delete/immigrant', 'RegistrarController@deleteImmigrant');

    # country report page
    Route::get('registrar/report/countries', 'RegistrarController@countryReport');

    # print overall country report
    Route::get('registrar/print/overall/report', 'RegistrarController@printGeneralCountryReport');

    # print report page
    Route::get('registrar/report/print', 'RegistrarController@printReportPage');

    # print report 
    Route::post('registrar/report/printing', 'RegistrarController@initiatePrinting');

    # logout
    Route::get('registrar/logout', 'RegistrarController@logout');
});

# entity route grouping
Route::group(['entity' => 'entity'], function () {

    # index page
    Route::get('/', function () {
        return view('login');
    });

    # admin login
    Route::post('/', 'EntityController@login');
    
    # fecth all countries
    Route::get('fetch/all/countries', 'EntityController@getAllCountries');

    # fecth all occupations
    Route::get('fetch/all/occupations', 'EntityController@getAllOccupations');
});