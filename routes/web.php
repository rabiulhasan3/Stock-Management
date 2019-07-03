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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('category','backend\CategoryController');
Route::get('category/list','backend\CategoryController@category_list');

Route::resource('brand','backend\BrandController');

Route::resource('subcategory','backend\SubcategoryController');

Route::resource('supplier','backend\SupplierController');

Route::resource('product','backend\ProductController');

Route::resource('purchase','backend\PurchaseController');

Route::resource('sales','backend\SalesController');
Route::post('sales/customercheck','backend\SalesController@customercheck');
Route::post('sales/productqunatitycheck','backend\SalesController@productqunatitycheck');

Route::post('purchase/childcategory','backend\PurchaseController@childcategory')->name('purchase.childcategory');

Route::post('purchase/product','backend\PurchaseController@productSearch')->name('purchase.proudct');

Route::resource('customer','backend\CustomerController');

Route::group(['prefix'=>'stock','namespace'=>'backend','as'=>'stock.'],function(){
	Route::get('/','StockController@index')->name('index');
	Route::get('/product-history/{id}','StockController@product_history')->name('product_history');
});




Route::group(['prefix'=>'report','namespace'=>'backend\report','as'=>'report.'],function(){
	Route::get('/','ReportController@index')->name('index');
	Route::get('/purchase-due-history','ReportController@total_purchase_due')->name('total_purchase_due');
	Route::get('/sales-due-history','ReportController@total_sales_due')->name('total_sales_due');
	Route::get('/purchase-paid-history','ReportController@total_purchase_paid')->name('total_purchase_paid');
	Route::get('/sales-paid-history','ReportController@total_sales_paid')->name('total_sales_paid');
});
