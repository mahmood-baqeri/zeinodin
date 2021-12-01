<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\BlogCommentsController;
use App\Http\Controllers\BiographyController;

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

//Route::get('/', function () {
//    return view('index');
//});
Route::get('/', 'HomeController@index')->name('indexPage');
Route::get('/contact', 'HomeController@contact');
Route::get('/about', 'HomeController@about');
Route::get('/vision', 'HomeController@vision');  //m    چشم انداز
Route::get('/mission', 'HomeController@mission');
Route::get('/team', 'HomeController@team');
Route::get('/guide', 'HomeController@guide')->name('guidePage'); //m  راهنما
Route::get('/category/{url}', 'HomeController@category');
Route::get('/list_user', 'HomeController@list_user');
Route::get('/consultation/{id}', 'HomeController@consultation');
Route::get('/events', 'HomeController@course');
Route::get('/events_detail/{url}', 'HomeController@course_detail');
Route::get('/page/{url}', 'HomeController@page');
Route::get('/business', 'HomeController@business');

#######
Route::get('statute', 'HomeController@statute');

Route::get('/user/insert_course', 'UserController@insert_course')->name('insert_course');

Route::get('order', 'UserController@order');
Route::any('payment/callback', 'UserController@payCallback');
//Route::get('shop','UserController@add_order');


###############################################################guidePage
Route::get('/boniad/news', 'BoniadNewsController@all')->name('boniadNews');
Route::get('/boniad/news/{slug}', 'BoniadNewsController@detail')->name('boniadNewsFront');
Route::get('/news/{url}', 'HomeController@news');
Route::get('/news_detail/{url}', 'HomeController@news_detail');
Route::get('blog', 'HomeController@blog')->name('blog');
Route::get('blog_detail/{slug}', 'HomeController@blog_detail')->name('blogDetail');
Route::post('blogCommentStore', 'Blog\BlogCommentsController@store')->name('blogCommentStore');
Route::get('blogCategory/{slug}', 'HomeController@blogCategory')->name('blogCategory');
Route::get('blogSearch', 'HomeController@blogSearch')->name('blogSearch');

Route::get('biography/{slug}', 'BiographyController@biographyShow')->name('biographyShow');

Route::get('album/{title}', 'MediaController@mediaAlbum')->name('mediaAlbum');
Route::get('media/{id}/{type}/{slug}', 'MediaController@mediaShow')->name('mediaShow');

Route::get('search', 'HomeController@search')->name('search');

Route::get('works/{slug}', 'BoniadWorksController@single')->name('work.single');

Route::group(['prefix' => 'product' ,'namespace' => 'Product'], function () {
    Route::get('/', 'ProductController@all')->name('product.all');
    Route::get('/{slug}', 'ProductController@detail')->name('product.detail');
    Route::get('search/item', 'ProductController@search')->name('product.search');
    Route::get('category/{slug}', 'ProductController@category')->name('product.category');
    Route::get('pay/sale', 'ProductController@pay')->name('product.pay');
    Route::get('pay/callback', 'ProductController@payCallback')->name('product.payCallback');
    Route::get('download/link', 'ProductController@downloadLink')->name('product.downloadLink');
});

###############################################################

Route::group(['prefix' => 'admin' , 'middleware' =>'auth'], function () {

    Route::resource('image', 'ImageController');
    Route::resource('works', 'BoniadWorksController');
    Route::resource('boniadNews', 'BoniadNewsController');
    Route::resource('product', 'Product\ProductController');
    Route::get('/product/discount/list', 'Product\ProductController@discount')->name('productDiscountShow');

    ############
    Route::get('/product/sale/list', 'Product\ProductController@sale')->name('productSale');

    Route::resource('productCategory', 'Product\CategoryController');

    Route::resource('blog', 'Blog\BlogController');
    Route::resource('blogCategory', 'Blog\BlogCategoryController');
    Route::resource('blogComments', 'Blog\BlogCommentsController');

    Route::resource('biography', 'BiographyController');
    Route::get('biography/create/{type}', 'BiographyController@create')->name('biography.create');

    Route::resource('media', 'MediaController');
    Route::resource('mediaCategory', 'MediaCategoryController');
    Route::get('media/{type}', 'MediaController@show')->name('media.index');
    Route::delete('media/{id}', 'MediaController@destroy')->name('media.destroy');

    Route::get('/index', 'AdminController@index');
//    user
    UrlAdmin('user', 'AdminController', '', 'role');
    Route::get('contactUser', 'AdminController@contact_user');

//    course
    UrlAdmin('events', 'AdminController', '', '');
    Route::get('/events/discount', 'AdminController@discount');
    Route::get('/events/listUser/{id}/{type}', 'AdminController@list_user');


//    slider
    UrlAdmin('slider', 'AdminController', 'page', '');

//    site
    UrlAdmin('site', 'AdminController', 'page', '');

//    page
    UrlAdmin('page', 'AdminController', '', '');
    Route::get('/page/contact', 'AdminController@page_contact');
    Route::get('/page/about', 'AdminController@page_about');
    Route::get('/page/vision', 'AdminController@page_vision');
    Route::get('/page/statute', 'AdminController@page_statute');
    Route::get('/page/mission', 'AdminController@page_mission');
    Route::post('/page/about/{id}', 'AdminController@pageUpdate')->name('admin.pageUpdate');

    Route::get('/page/guide', 'AdminController@page_guide');
    Route::get('/page/about_user', 'AdminController@page_about_user');
    Route::get('/page/customer', 'AdminController@page_customer');
    Route::get('/page/menu', 'AdminController@page_menu');

    //    File
    UrlAdmin('file', 'AdminController', '', '');
});


//Route::post('admin/edit_about' , 'AdminPageController@edit_about');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
