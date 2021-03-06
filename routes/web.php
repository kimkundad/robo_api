<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return redirect(url('login'));
});

Auth::routes();


Route::get('api/get_file_version', 'GetFileVersionController@get_file_version_api');
Route::get('admin/get_file_version', 'GetFileVersionController@index');
Route::get('admin/get_file_version/create', 'GetFileVersionController@create');

Route::get('get_qr_type/', 'HomeController@get_qr_type')->name('get_qr_type');

Route::get('admin/get_file_version/{id}/edit', 'GetFileVersionController@edit');
Route::get('api/get_file_version/{id}/edit', 'GetFileVersionController@api_edit');

Route::post('admin/get_file_version/store', 'GetFileVersionController@store');
Route::get('admin/get_file_version/delete/{id}', 'GetFileVersionController@destroy');

Route::post('api/add_file_version', 'GetFileVersionController@add_file_version');
Route::post('api/add_file_version_edit', 'GetFileVersionController@add_file_version_edit');

Route::get('/get_province', 'HomeController@get_province')->name('get_province');
Route::get('/get_dist/{id}', 'HomeController@get_dist')->name('get_dist');
Route::get('/get_subdist/{id}', 'HomeController@get_subdist')->name('get_subdist');

Route::get('/get_img_bank/{id}', 'HomeController@get_img_bank')->name('get_img_bank');

Route::get('/get_postal_codes/{id}/pro/{provi}/dist/{mydist}', 'HomeController@get_postal_codes')->name('get_postal_codes');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/get_document', 'HomeController@get_document')->name('get_document');
Route::get('/get_document_page/{id}', 'HomeController@get_document_page')->name('get_document_page');

Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/call_user', 'HomeController@call_user')->name('call_user');

Route::get('/get_cat_menu', 'HomeController@get_cat_menu')->name('get_cat_menu');
Route::get('/get_file_index', 'HomeController@get_file_index')->name('get_file_index');
Route::get('/get_first_menu', 'HomeController@get_first_menu')->name('get_first_menu');
Route::get('/get_file_id/{id}', 'HomeController@get_file_id')->name('get_file_id');

Route::post('check_logout', 'HomeController@check_logout');

Route::post('password/email', 'HomeController@forgot');
Route::post('check_username', 'HomeController@check_username');

Route::post('password/myreset', 'HomeController@myreset');

Route::post('/update_profile_avatar', 'HomeController@update_profile_avatar')->name('update_profile_avatar');

Route::post('/send_mail_to_contact', 'HomeController@send_mail_to_contact')->name('send_mail_to_contact');

Route::post('/post_blog', 'HomeController@post_blog')->name('post_blog');
Route::get('/get_banner_index', 'HomeController@get_banner_index')->name('get_banner_index');

Route::get('/get_package', 'HomeController@get_package')->name('get_package');

Route::get('/get_tex_address_by_id/{id}', 'HomeController@get_tex_address_by_id')->name('get_tex_address_by_id');

Route::post('/check_name_user', 'HomeController@check_name_user')->name('check_name_user');

Route::get('/get_banks', 'HomeController@get_banks')->name('get_banks');

Route::post('/reset_password', [AuthController::class, 'reset_password']);

Route::get('/get_api_service', [AuthController::class, 'get_api_service']);  


Route::post('/get_login', [AuthController::class, 'login']);
Route::post('/get_register', [AuthController::class, 'register']);
Route::get('/get-user-profile', [AuthController::class, 'userProfile']);  
Route::get('/get_tex_address', [AuthController::class, 'get_tex_address']); 
Route::post('/update_profile', [AuthController::class, 'update_profile']); 
Route::post('/add_my_biller_id', [AuthController::class, 'add_my_biller_id']); 
Route::post('/add_my_biller_file', [AuthController::class, 'add_my_biller_file']); 
Route::post('/add_my_biller_file2', [AuthController::class, 'add_my_biller_file2']); 
Route::post('/add_new_address', [AuthController::class, 'add_new_address']); 
Route::get('/get_my_biller_id', [AuthController::class, 'get_my_biller_id']); 
Route::get('/get_biller_by_id/{id}', [AuthController::class, 'get_biller_by_id']); 
Route::post('/change_status_biller_by_id', [AuthController::class, 'change_status_biller_by_id']); 
Route::post('/add_new_biller', [AuthController::class, 'add_new_biller']); 
Route::post('/add_new_device', [AuthController::class, 'add_new_device']); 
Route::get('/get_device', [AuthController::class, 'get_device']); 
Route::get('/get_device_by_id/{id}', [AuthController::class, 'get_device_by_id']); 
Route::post('/change_status_device_by_id', [AuthController::class, 'change_status_device_by_id']); 
Route::post('/add_new_api_service', [AuthController::class, 'add_new_api_service']); 
Route::get('/get_my_qr_type', [AuthController::class, 'get_my_qr_type']); 
Route::post('/edit_api_service', [AuthController::class, 'edit_api_service']); 
Route::post('/edit_api_service_callback_url', [AuthController::class, 'edit_api_service_callback_url']); 

Route::post('/edit_my_address', [AuthController::class, 'edit_my_address']); 

Route::get('/del_my_address/{id}', [AuthController::class, 'del_my_address']); 

Route::group(['middleware' => ['UserRole:manager|employee']], function() {

    Route::get('admin/dashboard', 'DashboardController@index');
    Route::get('admin/blog', 'DashboardController@blog');

    Route::resource('admin/user', 'UserController');

    Route::get('admin/user_search', 'UserController@user_search');
    Route::get('admin/biller_search', 'UserController@biller_search');
    Route::get('admin/api_request_search', 'UserController@api_request_search');


    Route::get('admin/biller_id_user', 'UserController@biller_id_user')->name('biller_id_user');
    Route::get('api/del_user_biller_id/{id}', 'UserController@del_user_biller_id')->name('del_user_biller_id');
    Route::get('admin/api_request_user', 'UserController@api_request_user')->name('api_request_user');
    Route::get('admin/edit_api_request_user/{id}', 'UserController@edit_api_request_user')->name('edit_api_request_user');
    Route::post('api/post_edit_api_request_user/{id}', 'UserController@post_edit_api_request_user')->name('post_edit_api_request_user');
    Route::get('api/del_api_request_user/{id}', 'UserController@del_api_request_user')->name('del_api_request_user');

    

    Route::resource('admin/bank', 'BankController');
    
    Route::get('api/del_bank/{id}', 'BankController@del_bank')->name('del_bank');
    Route::post('api/bank_status', 'BankController@bank_status')->name('bank_status');

    Route::get('api/del_user/{id}', 'UserController@del_user')->name('del_user');

    Route::get('admin/edit_add_id/{id}', 'AddressController@edit_add_id')->name('edit_add_id');
    Route::get('api/del_user_add_id/{id}', 'AddressController@del_user_add_id')->name('del_user_add_id');
    Route::post('api/edit_user_address', 'AddressController@edit_user_address')->name('edit_user_address');
    

    Route::get('admin/setting', 'SettingController@setting')->name('setting');
    Route::post('api/post_setting', 'SettingController@post_setting')->name('post_setting');

    Route::get('admin/create_biller_id/{id}', 'BillerController@create_biller_id')->name('create_biller_id');
    Route::get('admin/create_address_user/{id}', 'BillerController@create_address_user')->name('create_address_user');
    Route::get('admin/create_address_user2/{id}', 'BillerController@create_address_user2')->name('create_address_user2');
    
    
    Route::post('api/add_new_address', 'BillerController@add_new_address')->name('add_new_address');
    Route::post('api/add_new_address2', 'BillerController@add_new_address2')->name('add_new_address2');
 
   
    Route::get('/provinces','BillerController@getProvinces');
    Route::get('/province/{province_code}/amphoes','BillerController@getAmphoes');
    Route::get('/province/{province_code}/amphoe/{amphoe_code}/tambons','BillerController@getTambons');
    Route::get('/province/{province_code}/amphoe/{amphoe_code}/tambon/{tambon_code}/zipcodes','BillerController@getZipcodes');
    
    Route::post('api/add_new_biller_id/', 'BillerController@add_new_biller_id')->name('add_new_biller_id');
    Route::get('admin/edit_biller_id/{id}', 'BillerController@edit_biller_id')->name('edit_biller_id');

    Route::post('api/add_file1/', 'BillerController@add_file1')->name('add_file1');
    Route::get('api/get_document_1/{id}', 'BillerController@get_document_1')->name('get_document_1');

    Route::post('api/add_file4/', 'BillerController@add_file4')->name('add_file4');
    Route::get('api/get_document_4/{id}', 'BillerController@get_document_4')->name('get_document_4');

    Route::post('api/add_file2/', 'BillerController@add_file2')->name('add_file2');
    Route::get('api/get_document_2/{id}', 'BillerController@get_document_2')->name('get_document_2');
    Route::post('api/add_file3/', 'BillerController@add_file3')->name('add_file3');
    Route::get('get_api/get_document_3/{id}', 'BillerController@get_document_3')->name('get_document_3');
    Route::post('api/add_file5/', 'BillerController@add_file5')->name('add_file5');
    Route::post('api/add_file6/', 'BillerController@add_file6')->name('add_file6');
    
    Route::post('api/add_file_com/', 'BillerController@add_file_com')->name('add_file_com');
    Route::post('api/add_file_com2/', 'BillerController@add_file_com2')->name('add_file_com2');

    Route::get('api/del_image_3/{id}', 'BillerController@del_image_3')->name('del_image_3');
    Route::get('api/del_image_idcard/{id}', 'BillerController@del_image_idcard')->name('del_image_idcard');

    Route::post('api/post_edit_biller_id/{id}', 'BillerController@post_edit_biller_id')->name('post_edit_biller_id');

    Route::resource('admin/banner', 'BannerController');
    Route::get('api/del_banner/{id}', 'BannerController@del_banner')->name('del_banner');
    Route::post('api/banner_status', 'BannerController@banner_status')->name('banner_status');

    Route::resource('admin/cat_file', 'CatFileController');
    Route::get('api/del_cat_file/{id}', 'CatFileController@del_cat_file')->name('del_cat_file');
    Route::post('api/cat_file_status', 'CatFileController@cat_file_status')->name('cat_file_status');

    Route::resource('admin/get_file', 'GetFileController');
    Route::get('api/del_get_file/{id}', 'GetFileController@del_get_file')->name('del_get_file');
    Route::post('api/get_file_status', 'GetFileController@get_file_status')->name('get_file_status');
    Route::get('api/get_file_upload/{id}', 'GetFileController@get_file_upload')->name('get_file_upload');
    Route::resource('admin/get_qr_type', 'QrTypeController');
    Route::get('api/del_get_qr_type/{id}', 'QrTypeController@del_get_qr_type')->name('del_get_qr_type');
    Route::post('api/qr_type_status', 'QrTypeController@qr_type_status')->name('qr_type_status');

});






