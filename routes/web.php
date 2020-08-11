<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('website.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




#Admin Part Start
//Route::get('/post','Admin\PostController@all_post')->name('all_post');
//Route::get('/{anypath}','HomeController@index')->where('path','.*');

Route::group(['middleware' => ['auth']],  function (){
    //Category Route
    Route::post('/add-category','CategoryController@add_category');
    Route::get('/category','CategoryController@all_category');
    Route::get('/category/{id}','CategoryController@delete_category');
    Route::get('editcategory/{id}','CategoryController@edit_category');
    Route::post('update-category/{id}','CategoryController@update_category');
   // Route::get('/deletecategory/{id}','CategoryController@selected_category');


//Post Route
    Route::get('/post','PostController@all_post');
    Route::post('/savepost','PostController@save_post');
    Route::get('/delete/{id}','PostController@delete_post');
    Route::get('/post/{id}','PostController@edit_post');
    Route::post('/update/{id}','PostController@update_post');

});

Route::get('/blogpost','BlogController@get_all_blog_post');
Route::get('/singlepost/{id}','BlogController@getpost_by_id');

Route::get('/categories','BlogController@get_all_category');
Route::get('/categorypost/{id}','BlogController@get_all_post_by_cat_id');
Route::get('/search','BlogController@search_post');
Route::get('/latestpost','BlogController@latest_post');



