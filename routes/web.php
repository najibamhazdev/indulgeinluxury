<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// public route for the email template 
Route::get('emailtemplates/{id}', 'EmailtemplateController@showbrowser')->name('emailtemplates.showbrowser');

Route::group(['middleware' => 'auth'], function () {
	
	
	Route::get('icons', function () {
		return view('pages.icons')->with('pageFamily','profile')->with('keywords');
	})->name('icons');

	

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	
	

	Route::get('user/create', 'UserController@create')->name('user.create');
	Route::get('user/{id}', 'UserController@show')->name('user.show');
	Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
	//Route::get('user/delete/{id}', 'UserController@delete')->name('user.destroy');
	
	Route::get('user', 'UserController@index')->name('user.index');
	Route::get('profile', 'ProfileController@edit')->name('profile.edit');
	Route::put('profilepassword', 'ProfileController@password')->name('profile.password');
	Route::put('profile', 'ProfileController@update')->name('profile.update');
	
	Route::get('roles', 'RoleController@index')->name('roles')->middleware('permission');

	Route::post('user', 'HomeController@search')->name('pages.search');

	
	Route::get('users/load-{action}/{id}','UserController@loadModal');
	Route::get('roles/load-{action}/{id}','RoleController@loadModal');
	Route::get('clients/load-{action}/{id}','ClientsController@loadModal');
	Route::get('categories/load-{action}/{id}','CategoriesController@loadModal');
	Route::get('items/load-{action}/{id}','ItemsController@loadModal');
	Route::get('employees/load-{action}/{id}','EmployeesController@loadModal');
	Route::get('sales/load-{action}/{id}','SalesController@loadModal');
	Route::get('clientrequests/load-{action}/{id}','ClientrequestsController@loadModal');
	Route::get('expenses/load-{action}/{id}','ExpensesController@loadModal');
	Route::get('newsletters/load-{action}/{id}','NewsLetterController@loadModal');
	Route::get('subscribers/load-{action}/{id}', 'SubscribersController@loadModal');
	Route::get('assistances/load-{action}/{id}','AssistancesController@loadModal');
	Route::get('todolists/load-{action}/{id}','TodolistsController@loadModal');
	Route::get('brands/load-{action}/{id}','BrandsController@loadModal');

	Route::get('campaigns/load-{action}/{id}','CampaignsController@loadModal');
	Route::post('campaigns/{id}','CampaignsController@send')->name('campaigns.send');
	Route::post('campaigns/{id}','CampaignsController@sendpreview')->name('campaigns.sendpreview');
	Route::get('producttemplates/load-{action}/{id}','ProducttemplateController@loadModal');
	Route::get('emailtemplates/load-{action}/{id}','EmailtemplateController@loadModal');
	Route::post('producttemplates/{id}','ProducttemplateController@storefromweb')->name('producttemplates.storefromweb');
	

	Route::patch('clientrequests', 'ClientrequestsController@filter')->name('clientrequests.index');
	Route::get('salesreports', 'SalesController@salesreports')->name('sales.reports');
	Route::patch('salesreports', 'SalesController@filter')->name('sales.reports');
	Route::get('autocompleteclients','SalesController@getAutocompleteData');

	Route::patch('expensesreports', 'ExpensesController@filter')->name('expenses.reports');
	Route::get('expensesreports', 'ExpensesController@index')->name('expenses.index');

	Route::patch('todolists', 'TodolistsController@filter')->name('todolists.reports');
	Route::get('todolistsreports', 'TodolistsController@index')->name('todolists.index');
	Route::put('todolists/{id}','TodolistsController@storeDone')->name('todolists.storeDone');

	//===------ test autocomplete
	//Route::get('admin/invoice/create','InvoiceController@create');
	// 
	
	
});




Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
	Route::resource('clients','ClientsController');
	Route::resource('categories','CategoriesController');
	Route::resource('items','ItemsController');
	Route::resource('employees','EmployeesController');
	Route::resource('sales','SalesController');
	Route::resource('clientrequests','ClientrequestsController');
	Route::resource('expenses','ExpensesController');
	Route::resource('newsletters','NewsLetterController');
	Route::resource('subscribers','SubscribersController');
	Route::resource('assistances','AssistancesController');
	Route::resource('todolists','TodolistsController');
	Route::resource('brands','BrandsController');
	Route::resource('campaigns','CampaignsController');
	Route::resource('emailtemplates','EmailtemplateController');
	Route::resource('producttemplates','ProducttemplateController');
});
