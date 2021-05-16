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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/get_document', 'HomeController@get_document')->name('get_document');


Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/call_user', 'HomeController@call_user')->name('call_user');

Route::post('check_logout', 'HomeController@check_logout');

Route::post('password/email', 'HomeController@forgot');
Route::post('check_username', 'HomeController@check_username');

Route::post('password/myreset', 'HomeController@myreset');

Route::post('/update_profile_avatar', 'HomeController@update_profile_avatar')->name('update_profile_avatar');

Route::post('/send_mail_to_contact', 'HomeController@send_mail_to_contact')->name('send_mail_to_contact');

Route::post('/post_blog', 'HomeController@post_blog')->name('post_blog');
Route::get('/get_banner_index', 'HomeController@get_banner_index')->name('get_banner_index');

Route::get('/get_package', 'HomeController@get_package')->name('get_package');
Route::post('/check_name_user', 'HomeController@check_name_user')->name('check_name_user');



Route::post('/reset_password', [AuthController::class, 'reset_password']);

Route::post('/get_login', [AuthController::class, 'login']);
Route::post('/get_register', [AuthController::class, 'register']);
Route::get('/get-user-profile', [AuthController::class, 'userProfile']);  
Route::get('/get_tex_address', [AuthController::class, 'get_tex_address']); 
Route::post('/update_profile', [AuthController::class, 'update_profile']); 

Route::group(['middleware' => ['UserRole:manager|employee']], function() {

    Route::get('admin/dashboard', 'DashboardController@index');
    Route::resource('admin/user', 'UserController');
    Route::resource('admin/bank', 'BankController');
    
    Route::get('api/del_bank/{id}', 'BankController@del_bank')->name('del_bank');
    Route::post('api/bank_status', 'BankController@bank_status')->name('bank_status');

    Route::get('api/del_user/{id}', 'UserController@del_user')->name('del_user');

    Route::get('admin/setting', 'SettingController@setting')->name('setting');
    Route::post('api/post_setting', 'SettingController@post_setting')->name('post_setting');

    Route::get('admin/create_biller_id/{id}', 'BillerController@create_biller_id')->name('create_biller_id');
    Route::post('api/add_new_biller_id/', 'BillerController@add_new_biller_id')->name('add_new_biller_id');
    Route::get('admin/edit_biller_id/{id}', 'BillerController@edit_biller_id')->name('edit_biller_id');

    Route::post('api/add_file1/', 'BillerController@add_file1')->name('add_file1');
    Route::get('api/get_document_1/{id}', 'BillerController@get_document_1')->name('get_document_1');
    Route::post('api/add_file2/', 'BillerController@add_file2')->name('add_file2');
    Route::get('api/get_document_2/{id}', 'BillerController@get_document_2')->name('get_document_2');
    Route::post('api/add_file3/', 'BillerController@add_file3')->name('add_file3');
    Route::get('api/get_document_3/{id}', 'BillerController@get_document_3')->name('get_document_3');
    Route::get('api/del_image_3/{id}', 'BillerController@del_image_3')->name('del_image_3');

    Route::post('api/post_edit_biller_id/{id}', 'BillerController@post_edit_biller_id')->name('post_edit_biller_id');

    Route::resource('admin/banner', 'BannerController');
    Route::get('api/del_banner/{id}', 'BannerController@del_banner')->name('del_banner');
    Route::post('api/banner_status', 'BannerController@banner_status')->name('banner_status');


});






