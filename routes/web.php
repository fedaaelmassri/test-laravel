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


// Profile Routes (show and change password)
Route::namespace('profile')->prefix('/profile')->middleware('auth')->group(function () {


    Route::get('/{id}', 'ProfileController@show_profile')->name('profile');
     Route::post('/profile/changePassword','ProfileController@changePassword')->name('changePassword');
    });
    
// product Routes(show , create page, store ,delete,get to edit,update)

Route::namespace('product')->prefix('/products')->middleware('auth')->group(function () {


        Route::get('/', 'ProductController@index')->name('products');
        Route::get('/create', 'ProductController@create')->name('products.create');
        Route::post('/store', 'ProductController@store')->name('products.store');
        Route::get('/delete/{id}', 'ProductController@delete')->name('products.delete');
        Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
        Route::put('{id}', 'ProductController@update')->name('products.update');
        
         });
     
 //auth route

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
    
     
// Logout Route
Route::get('/admin/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('admin.logout');

