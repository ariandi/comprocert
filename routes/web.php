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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Front\Home\FrontController@index')->name('front.home');
Route::get('/home', 'Front\Home\FrontController@index')->name('front.home');
Route::post('/comments/store-front', 'Front\Home\CommentController@storeFront')->name('comments.store-front');

Route::get('/loginadmin', 'Auth\LoginController@loginadmin')->name('loginadmin');
Route::get('/registerfronts', 'Front\Home\FrontController@registerfront')->name('registerfronts');
Route::post('/loginfront', 'Auth\LoginController@storeloginfront')->name('storeloginfront');

Auth::routes();

Route::group(['middleware' => ['auth', 'role', 'web'], 'prefix' => 'admin'], function(){
	Route::get('/', 'HomeController@index')->name('home');

	/// Module Persons
	Route::post('/persons/input-person-role/{user_id}/{role_id}', 'Admin\PersonController@inputPersonRole')->name('persons.input-person-role');
	Route::delete('/persons/delete-person-role/{id}', 'Admin\PersonController@deletePersonRole')->name('persons.delete-person-role');
	Route::get('persons/getAPI', 'Admin\PersonController@getAPI')->name('persons.getAPI');
	Route::get('/persons/edit-ajax/{id}', 'Admin\PersonController@editAjax')->name('person.edit-ajax');
	Route::get('/persons/person-role/{user_id}', 'Admin\PersonController@personRole')->name('person.person-role');
	Route::get('/persons/list-of-role/{user_id}', 'Admin\PersonController@listOfRole')->name('person.list-of-role');
	Route::resource('persons', 'Admin\PersonController');
	//// end module person

	////Module Company
	Route::get('companies/get-datatables-data/{parent?}', 'Admin\CompanyController@getDatatablesData')->name('companies.getdatatablesdata');
	Route::get('companies/get-employee/{id}', 'Admin\CompanyController@getEmployee')->name('companies.get-employee');
	Route::get('companies/get-related-company/{id}', 'Admin\CompanyController@getRelatedCompany')->name('companies.get-related-company');
	Route::post('companies/save-related-company', 'Admin\CompanyController@saveRelatedCompany')->name('companies.save-related-company');
	Route::resource('companies', 'Admin\CompanyController');
	/////end company

	////Module Contentmanagement
	Route::get('nodes/{parent?}/{lvl?}/ajaxnode', 'Admin\NodeController@publish2ajaxnode')->name('nodes.ajaxnode');
	Route::post('/nodes/{id}/edit/priority', 'Admin\NodeController@nodePriority')->name('nodes.editpriority');
	Route::post('/nodes/{id}/edit/unlink', 'Admin\NodeController@nodeUnLink')->name('nodes.editunlink');
	Route::post('/nodes/{id}/edit/{parent?}', 'Admin\NodeController@nodeLink')->name('nodes.editlink');
	Route::get('/nodes/content-text/{id}', 'Admin\NodeController@contentText')->name('nodes.content-text');
	Route::get('/nodes/content-img/{id}', 'Admin\NodeController@contentImg')->name('nodes.content-img');
	Route::get('/nodes/content-detail/{id}', 'Admin\NodeController@contentDet')->name('nodes.content-detail');
	Route::put('/nodes/content-text/{id}', 'Admin\NodeController@contentTextUpdate')->name('nodes.content-text-update');
	Route::put('/nodes/content-img/{id}', 'Admin\NodeController@contentImgUpdate')->name('nodes.content-img-update');
	Route::resource('nodes', 'Admin\NodeController');
	/////end Contentmanagement

	/// Module Product
	Route::get('products/{id}/edit-ajax', 'Admin\ProductController@editAjax')->name('product.editajax');
	Route::get('products/{id}/edit-product-text', 'Admin\ProductController@editProductText')->name('product.editproducttext');
	Route::put('products/update-ajax/{id}', 'Admin\ProductController@updateAjax')->name('product.updateajax');
	Route::get('products/{id}/edit-product-media', 'Admin\ProductController@editProductMedia')->name('product.editproductmedia');
	Route::post('products/update-product-media/{id?}', 'Admin\ProductController@updateProductMediaAjax')->name('product.updateproductmediaajax');
	Route::delete('products/delete-product-media/{id}', 'Admin\ProductController@deleteProductMediaAjax')->name('product.deleteproductmediaajax');
	Route::get('products/get-datatables-data', 'Admin\ProductController@getDatatablesData')->name('products.getdatatablesdata');
	Route::resource('products', 'Admin\ProductController');
	/// End Module Product


	/// Certificate Module
	Route::get('certificates/get-datatables-data', 
		'Admin\CertificateController@getDatatablesData')
		->name('certificates.getdatatablesdata');
	Route::resource('certificates', 'Admin\CertificateController');
	/// End Certificate Module

	/// Comment Module
	Route::get('comments/get-datatables-data', 
		'Front\Home\CommentController@getDatatablesData')
		->name('comments.getdatatablesdata');
	Route::resource('comments', 'Front\Home\CommentController');
	/// End Comment Module
});


Route::get('/{alias?}', 'Front\Home\FrontController@content')->name('no.alias');