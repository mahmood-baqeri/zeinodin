<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/admin/edit_about' , 'AdminPageController@edit_about');
Route::post('/admin/edit_guide' , 'AdminPageController@edit_guide');
Route::post('/admin/edit_contact' , 'AdminPageController@edit_contact');

Route::post('/admin/insert_customer' , 'AdminPageController@insert_customer');
Route::post('/admin/edit_customer' , 'AdminPageController@edit_customer');
Route::post('/admin/edit_show_customer' , 'AdminPageController@edit_show_customer');
Route::post('/admin/delete_customer' , 'AdminPageController@delete_customer');
Route::post('/admin/insert_menu' , 'AdminPageController@insert_menu');
Route::post('/admin/edit_show_menu' , 'AdminPageController@edit_show_menu');
Route::post('/admin/edit_menu' , 'AdminPageController@edit_menu');
Route::post('/admin/delete_menu' , 'AdminPageController@delete_menu');
Route::post('/admin/insert_page' , 'AdminPageController@insert_page');
Route::post('/admin/edit_page' , 'AdminPageController@edit_page');
Route::post('/admin/delete_page' , 'AdminPageController@delete_page');
Route::post('/admin/insert_site' , 'AdminPageController@insert_site');
Route::post('/admin/edit_site' , 'AdminPageController@edit_site');
Route::post('/admin/delete_site' , 'AdminPageController@delete_site');

Route::post('/admin/insert_user_about' , 'AdminPageController@insert_user_about');
Route::post('/admin/edit_user_about' , 'AdminPageController@edit_user_about');
Route::post('/admin/edit_show_user_about' , 'AdminPageController@edit_show_user_about');
Route::post('/admin/delete_user_about' , 'AdminPageController@delete_user_about');

Route::post('/admin/insert_slider' , 'AdminPageController@insert_slider');
Route::post('/admin/edit_slider' , 'AdminPageController@edit_slider');
Route::post('/admin/delete_slider' , 'AdminPageController@delete_slider');

Route::post('/admin/insert_user' , 'AdminUserController@insert_user');
Route::post('/admin/edit_user' , 'AdminUserController@edit_user');
Route::post('/admin/delete_user' , 'AdminUserController@delete_user');
Route::post('/admin/change_position' , 'AdminUserController@change_position');

Route::post('/admin/delete_contact_form' , 'AdminUserController@delete_contact_form');

Route::post('/admin/insert_course' , 'AdminCourseController@insert_course');
Route::post('/admin/edit_course' , 'AdminCourseController@edit_course');
Route::post('/admin/delete_course' , 'AdminCourseController@delete_course');
Route::post('/admin/delete_course_user' , 'AdminCourseController@delete_course_user');
Route::post('/admin/insert_discount' , 'AdminCourseController@insert_discount');
Route::post('/admin/delete_discount' , 'AdminCourseController@delete_discount');

Route::post('/admin/product_insert_discount' , 'Product\ProductController@insert_discount');
Route::post('/admin/product_delete_discount' , 'Product\ProductController@delete_discount');
Route::post('/user/check_product_discount_code' , 'Product\ProductController@check_code');

Route::post('/admin/insert_file' , 'AdminFileController@insert_file');
Route::post('/admin/delete_file' , 'AdminFileController@delete_file');


//User
Route::post('/user/insert_contact' , 'UserController@insert_contact');
Route::post('/user/insert_course' , 'UserController@insert_course');
Route::post('/user/check_code' , 'UserController@check_code');



Route::post('checkDuplicateCourseDiscountCode' , 'UserController@checkDuplicateCode');
Route::post('checkDuplicateProductDiscountCode' , 'Product\ProductController@checkDuplicateCode');


//ApiUrlAdmin('customer' , "AdminPageController");
//ApiUrlAdmin('about' , "AdminPageController");
//ApiUrlAdmin('contact' , "AdminPageController");
//ApiUrlAdmin('page' , "AdminPageController");
