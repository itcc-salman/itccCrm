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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    // Users Management
    Route::get('users','UserController@index')->name('users');
    Route::post('getuser','UserController@edit')->name('getuser');
    Route::post('userstore', 'UserController@userCreate')->name('userCreate');
    Route::post('useredit', 'UserController@userEdit')->name('userEdit');
    Route::get('userdelete/{id?}', 'UserController@destroy')->name('userDelete');

    // Role Management
    Route::get('roles','RoleController@index')->name('roles');
    Route::post('getrole','RoleController@edit')->name('getrole');
    Route::post('rolestore', 'RoleController@roleCreate')->name('roleCreate');
    Route::post('roleedit', 'RoleController@roleEdit')->name('roleEdit');
    Route::get('roledelete/{id?}', 'RoleController@destroy')->name('roleDelete');

    // Customer
    Route::get('customers','CustomerController@index')->name('customers');
    Route::post('viewcustomer','CustomerController@show')->name('viewcustomer');
    Route::get('customercreate','CustomerController@customerCreate')->name('customercreate');
    Route::post('customerstore','CustomerController@customerCreateStore')->name('customerstore');
    Route::get('customeredit/{id}','CustomerController@customerEdit')->name('customeredit');
    Route::post('customereditstore','CustomerController@customerEditStore')->name('customereditstore');
    Route::post('customerdelete', 'CustomerController@destroy')->name('customerDelete');

    Route::get('/docs/{id}','DocumentController@docs')->name('docs');

    // Master
    Route::group(['prefix' => 'master'], function() {
        // Industry
        Route::get('industry', 'IndustryController@industry')->name('masterindustry');
        Route::post('industrycreate', 'IndustryController@industryCreate')->name('industrycreate');
        Route::post('industryget', 'IndustryController@industryget')->name('industryget');
        Route::post('industryedit', 'IndustryController@industryEdit')->name('industryedit');
        Route::get('industrydelete/{id?}', 'IndustryController@industryDestroy')->name('industrydelete');

        // Documents
        Route::get('documents', 'DocumentController@documents')->name('masterdocuments');
        Route::post('documentcreate', 'DocumentController@documentCreate')->name('documentcreate');
        Route::post('documentget', 'DocumentController@documentget')->name('documentget');
        Route::post('documentedit', 'DocumentController@documentEdit')->name('documentedit');
        Route::get('documentdelete/{id?}', 'DocumentController@documentDestroy')->name('documentdelete');
    });

    // Forms
    Route::match(['GET','POST'],'directdebitform', 'FormsController@directDebitForm')->name('directdebitform');
    Route::match(['GET','POST'],'websalesform', 'FormsController@webSalesForm')->name('websalesform');
    Route::match(['GET','POST'],'digitalsalesform', 'FormsController@digitalSalesForm')->name('digitalsalesform');
});
