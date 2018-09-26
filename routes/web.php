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
Route::get('/changelanguage/{langID?}', 'Front\Home\FrontController@changeLanguage')->name('changeLanguage');

Route::get('/loginadmin', 'Auth\LoginController@loginadmin')->name('loginadmin');
// Route::get('/loginfront', 'Auth\LoginController@registerfront')->name('loginfront');
Route::get('/registerfronts', 'Front\Home\FrontController@registerfront')->name('registerfronts');
Route::post('/loginfront', 'Auth\LoginController@storeloginfront')->name('storeloginfront');

// Route::get('/person/sync', 'Admin\PersonController@sync')->name('loginadmin');

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


	////Module Statement
	Route::get('statements/ajax-list/{parent?}/{level?}', 'admin\StatementController@statementAjaxList')->name('statements.ajax-list');
	Route::get('statements/get-data-tables-data/{id?}', 'admin\StatementController@getDatatablesData')->name('statements.get-data-tables-data');
	Route::put('statements/link-unlink/{id?}/{parent?}', 'admin\StatementController@linkUnlink')->name('statements.link-unlink');
	Route::put('statements/priority/', 'admin\StatementController@priority')->name('statements.priority');
	Route::get('statements/get-product/{id?}', 'admin\StatementController@getProductData')->name('statements.get-product');
	Route::get('statements/get-product-all/{id?}', 'admin\StatementController@getProductDataAll')->name('statements.get-product-all');
	Route::get('statements/edit-ajax/{id?}', 'admin\StatementController@editAjax')->name('statements.edit-ajax');
	Route::put('statements/edit-tablename/{id?}', 'admin\StatementController@editTablename')->name('statements.edit-tablename');
	Route::put('statements/product-link/{id}', 'admin\StatementController@productLink')->name('statements.product-link');
	Route::resource('statements', 'admin\StatementController');
	/////end Statement

	/// Module Language String
	Route::get('/languagestring/', 'admin\LanguagestringController@index')->name('languagestring');
	Route::get('/languagestring/getLangs', 'admin\LanguagestringController@getLangs')->name('languagestring.getLangs');
	Route::post('/languagestring/store', 'admin\LanguagestringController@store')->name('languagestring.storeLangs');
	/// End Module Language String

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

	// Module order sale
	Route::get('/ordersale/getDatatablesData', 'admin\OrderSaleController@getDatatablesData')->name('ordersale.getDatatablesData');
	Route::get('/ordersale/delete/{id}/{table?}', 'admin\OrderSaleController@delete')->name('ordersale.delete');
	Route::get('/ordersale/invoiced/{id}', 'admin\OrderSaleController@invoiced')->name('ordersale.invoiced');
	// End Module order sale

	////Sync Db to Wisehouse
	Route::get('/sync', 'admin\SyncwisehouseController@index')->name('sync.index');
	Route::get('/sync/range-product', 'admin\SyncwisehouseController@syncRangeProduct')->name('sync.rangeproduct');
	Route::get('/sync/product', 'admin\SyncwisehouseController@syncProduct')->name('sync.product');
	Route::get('/sync/company', 'admin\SyncwisehouseController@syncCompany')->name('sync.company');
	Route::get('/sync/extraques/{limit?}/{offset?}', 'admin\SyncwisehouseController@syncExtraquestion')->name('sync.extraques');
	Route::get('/sync/role', 'admin\SyncwisehouseController@syncRole')->name('sync.role');
	Route::get('/sync/statement', 'admin\SyncwisehouseController@syncStatement')->name('sync.statement');
	////Sync Db to Wisehouse

	////Module Roles
	Route::get('roles/get-datatables-data', 'admin\RoleController@getDatatablesData')->name('roles.getdatatablesdata');
	Route::get('roles/role-action-list', 'admin\RoleController@getRoleActionList')->name('roles.get-role-action-list');
	Route::get('roles/get-datatables-data-action', 'admin\RoleController@getDatatablesDataAction')->name('roles.getdatatablesdataaction');
	Route::get('roles/role-action-create', 'admin\RoleController@roleActionCreate')->name('roles.role-action-create');
	Route::post('roles/role-action-store', 'admin\RoleController@roleActionStore')->name('roles.role-action-store');
	Route::get('roles/role-action-edit/{id}', 'admin\RoleController@roleActionEdit')->name('roles.role-action-edit');
	Route::put('roles/role-action-update/{id}', 'admin\RoleController@roleActionUpdate')->name('roles.role-action-update');
	Route::resource('roles', 'admin\RoleController');
	/////end Roles
});

Route::resources([
    '/post' => 'Admin\PostController',
    '/node' => 'Admin\NodeController',
    '/admin/ordersale' => 'Admin\OrderSaleController',
    '/admin/ordersubscriptions' => 'Admin\OrdersubscriptionsController',
    '/admin/invoice' => 'Admin\InvoiceController',
    '/admin/registrations' => 'Admin\RegistrationController'
]);


Route::get('no/profiles', 'Front\Profile\ProfileController@index')->name('profiles.no.index');
Route::get('en/profiles', 'Front\Profile\ProfileController@index')->name('profiles.en.index');
Route::get('no/om_oss/{content?}', 'Front\Home\FrontController@omoss')->name('om_oss');

// My profile
Route::get('api-web/v1/profile/', 'Front\Api\ProfileController@index')->name('api.profile.index');
Route::put('api-web/v1/profile/update/{id?}', 'Front\Api\ProfileController@update')->name('api.profile.update');
Route::get('api-web/v1/profile/update/{id?}', 'Front\Api\ProfileController@edit')->name('api.profile.edit');

Route::get('api-web/v1/profile/updatepassword/{id?}', 'Front\Api\ProfileController@editPassword')->name('api.profile.editpassword');
Route::put('api-web/v1/profile/passwordstore/{id?}', 'Front\Api\ProfileController@passwordStore')->name('api.profile.passwordstore');

Route::get('api-web/v1/profile/subscription', 'Front\Api\ProfileController@subscription')->name('api.profile.subscription');

Route::get('api-web/v1/profile/yesdoit', 'Front\Api\ProfileController@yesdoit')->name('api.profile.yesdoit');
Route::post('api-web/v1/profile/yesdoit', 'Front\Api\ProfileController@yesdoitstore')->name('api.profile.yesdoitstore');

Route::get('api-web/v1/profile/action', 'Front\Api\ProfileController@action')->name('api.profile.action');
Route::post('api-web/v1/profile/action', 'Front\Api\ProfileController@actionstore')->name('api.profile.actionstore');

// myanalyses
Route::get('api-web/v1/profile/myanalyses', 'Front\Api\MyanalyseController@index')->name('api.myanalyses.index');
Route::post('api-web/v1/profile/myanalysessave', 'Front\Api\MyanalyseController@save')->name('api.myanalyses.save');
Route::post('api-web/v1/profile/myanalysesadd', 'Front\Api\MyanalyseController@add')->name('api.myanalyses.add');
Route::get('api-web/v1/profile/liststatement/{mainnode}/{subnode?}/{tipe?}', 'Front\Api\MyanalyseController@liststatement')->name('api.myanalyses.liststatement');
Route::get('/no/profile/detailanalyses/{id}/{tipe?}/{year?}/{month?}', 'Front\Api\MyanalyseController@detail')->name('analyses.detail');
Route::post('api-web/v1/profile/analyse/addstatement', 'Front\Api\MyanalyseController@addstatement')->name('api.myanalyses.addstatement');
Route::get('/no/analyse/delstatement/{id}/{parent?}/{mainnode?}/{tipe?}', 'Front\Api\MyanalyseController@removestatement')->name('api.myanalyses.removestatement');
// end myanalyses

Route::post('api-web/v1/profile/storecalendar', 'Front\Api\ProfileController@storecalendar')->name('api.profile.storecalendar');
//End My Profile

// Analysis
Route::get('/no/profile/analysis/{NodeID}/{year?}/{month?}/{team?}', 'Front\Analysis\AnalysisController@index')->name('profile.analysis.index');

Route::get('/no/profile/analysisdetailleft/{NodeID}/{year?}/{month?}', 'Front\Analysis\AnalysisController@getDataDetailLeft')->name('profile.analysisdetleft.index');
Route::get('/no/profile/analysisdetailright/{NodeID}/{year?}/{month?}', 'Front\Analysis\AnalysisController@getDataDetailRight')->name('profile.analysisdetright.index');

Route::post('/no/profile/analysis/yesdoitstorebynode', 'Front\Analysis\AnalysisController@yesdoitstorebynode')->name('profile.analysis.yesdoitstorebynode');

Route::get('/no/profile/analysissurvey/finish/{NodeID}/{ParentNodeID}', 'Front\Analysis\AnalysisController@getSurveyFinish')->name('profile.analysissurvey.finish');
Route::get('/no/profile/analysissurvey/finishall/{NodeID}', 'Front\Analysis\AnalysisController@getSurveyFinishAll')->name('profile.analysissurvey.finishall');

Route::get('/no/profile/analysissurvey/{NodeID}/{page?}/{ParentNodeID}', 'Front\Analysis\AnalysisController@getSurvey')->name('profile.analysissurvey.index');
Route::get('/no/profile/analysissurveyall/{NodeID}/{page?}', 'Front\Analysis\AnalysisController@getSurveyall')->name('profile.analysissurveyall.index');

Route::post('/no/profile/analysissurvey/{NodeID}/{page?}', 'Front\Analysis\AnalysisController@getSurveyStore')->name('profile.analysissurvey.store');
Route::post('/no/profile/analysissurveyall/{NodeID}/{page?}', 'Front\Analysis\AnalysisController@getSurveyStoreAll')->name('profile.analysissurvey.storeall');
//Analysis

// Create Project Team
Route::get('/no/profile/createprojectteam', 'Front\Analysis\ProjectTeamController@index')->name('profile.projectteam.index');
Route::put('/no/profile/createprojectteam', 'Front\Analysis\ProjectTeamController@updateSubList')->name('profile.projectteam.updatesublist');
Route::put('/no/profile/updateprojectteam', 'Front\Analysis\ProjectTeamController@updateList')->name('profile.projectteam.updatelist');
Route::get('/no/notes/{PersonID}', 'Front\Analysis\ProjectTeamController@getNotes')->name('notes.getnotes.no');
Route::get('/en/notes/{PersonID}', 'Front\Analysis\ProjectTeamController@getNotes')->name('notes.getnotes.en');
// Create Project Team


// selectPersonTeam
Route::get('api-web/v1/selectpersonteam/{PersonID}', 'Front\Api\ProfileController@selectPersonTeam')->name('api.profile.selectpersonteam');
// selectPersonTeam

// inviteTeam
Route::get('api-web/v1/inviteteammember/{PersonID}', 'Front\Analysis\InviteController@member')->name('api.invite.member');
Route::post('api-web/v1/inviteteammember/sendEmail', 'Front\Analysis\InviteController@sendEmail')->name('api.invite.sendEmail');

// inviteTeam

//delete analyses //
Route::get('api-web/v1/deleteanalyses/{PersonID}', 'Front\Analysis\AnalysisController@deleteanalyses')->name('api.analyses.deleteanalyses');
Route::post('api-web/v1/analyses/delete', 'Front\Analysis\AnalysisController@delete')->name('api.analyses.delete');
//delete analyses //

Route::get('/no/blogg/', 'Front\Blog\BloggController@bloggcontent')->name('blogg');
Route::get('no/blogg/create', 'Front\Blog\BloggController@bloggcreate')->name('blogg.bloggcreate');
Route::post('no/blogg/store', 'Front\Blog\BloggController@store')->name('blogg.stores');
Route::get('no/blogg/{id}/edit/{parent?}', 'Front\Blog\BloggController@edit')->name('blogg.edit');
Route::get('no/blogg/{alias?}', 'Front\Blog\BloggController@bloggcontent')->name('no.blog.alias');
Route::post('no/blogg/update/{id?}', 'Front\Blog\BloggController@update')->name('blogg.update');

Route::get('no/{alias?}', 'Front\Home\FrontController@content')->name('no.alias');
Route::get('en/{alias?}', 'Front\Home\FrontController@content')->name('en.alias');

Route::post('no/home/subscrip', 'Front\Home\FrontController@sendEmailSubscript')->name('front.sendEmailSubscript');