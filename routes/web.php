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
Route::get('/',[
	'uses'=>'Frontend\HomeController@index',
	'as'  =>'/'
]);
Route::post('shop/product/select','Frontend\CartController@productSelect');
Route::get('shop/product/cart-details','Frontend\CartController@productCartDetails');
Route::post('shop/product/quantity','Frontend\CartController@productQuantity');
//Cart Item Delete 
Route::post('cart/product/delete','Frontend\CartController@deleteCartProduct');
Route::post('shop/product/payment_method','inventory\OrderController@productPaymentMethod');
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth','verified']);




Route::group(['prefix'=>'{user}','where'=>['user'=>'[A-Za-z]+'],'middleware'=>['auth', 'verified']],function () { 

	//setting Route
    Route::get('settings/profile','Settings\ProfileController@index');
    Route::post('settings/profile/image','Settings\ProfileController@imageUpload');

    //Invenroty Route
    						###Category###
    Route::group(['middleware'=>'checkRole:admin'],function(){


    Route::get('inventory/category','inventory\CategoryController@index');
    Route::post('inventory/category','inventory\CategoryController@createCategory');
    Route::post('inventory/category/update','inventory\CategoryController@updateCategory');
    Route::post('inventory/category/visibility','inventory\CategoryController@categoryVisibility');
                            ###Sub-Category###
    Route::get('inventory/sub_category','inventory\SubCategoryController@index');
    Route::post('inventory/sub_category','inventory\SubCategoryController@createSubCategory');
    Route::post('inventory/sub_category/update','inventory\SubCategoryController@updateSubCategory');
    Route::post('inventory/subCategory/visibility','inventory\SubCategoryController@subCategoryVisibility');

                                   ###Brand###
    Route::get('inventory/brand','inventory\BrandController@index');
    Route::post('inventory/brand','inventory\BrandController@createBrand');
    Route::post('inventory/brand/visibility','inventory\BrandController@brandVisibility');

                                   ###Product###
    Route::get('inventory/product','inventory\ProductController@index');
    Route::post('inventory/product','inventory\ProductController@createProduct');
    Route::post('inventory/dynamic/data','inventory\ProductController@dynamicProduct');
    Route::post('inventory/brand/visibility','inventory\BrandController@brandVisibility');

            });
    });