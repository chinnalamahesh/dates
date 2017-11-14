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

Route::get('/', function () {
    return view('welcome');
});

/* colors */
Route::get('colors', 'ColorsController@index');
Route::get('colors/create', 'ColorsController@create');
Route::post('colors/create', 'ColorsController@store');
Route::post('colors/update', 'ColorsController@update');
Route::get('colors/delete/{id}', 'ColorsController@destroy');

/* colors */

Route::resource('colors', 'ColorsController');

/* categorys */
Route::get('categorys', 'CategoryController@index');
Route::get('categorys/create', 'CategoryController@create');
Route::post('categorys/create', 'CategoryController@store');
Route::get('categorys/{id}', 'CategoryController@show');
Route::post('categorys/update', 'CategoryController@update');
Route::get('categorys/delete/{id}', 'CategoryController@destroy');

/* categorys */

/*How did you hear about us?*/

Route::get('howdid', 'HowdidController@index');
Route::get('howdid/create', 'HowdidController@create');
Route::post('howdid/create', 'HowdidController@store');
Route::get('howdid/{id}', 'HowdidController@show');
Route::post('howdid/update', 'HowdidController@update');
Route::get('howdid/delete/{id}', 'HowdidController@destroy');

/*How did you hear about us?*/


/*E payments*/

Route::get('epayments', 'EpaymentsController@index');
Route::get('epayments/create', 'EpaymentsController@create');
Route::post('epayments/create', 'EpaymentsController@store');
Route::get('epayments/{id}', 'EpaymentsController@show');
Route::post('epayments/update', 'EpaymentsController@update');
Route::get('epayments/delete/{id}', 'EpaymentsController@destroy');

/*E payments*/


/*Skills*/

Route::get('skills', 'SkillsController@index');
Route::get('skills/create', 'SkillsController@create');
Route::post('skills/create', 'SkillsController@store');
Route::get('skills/{id}', 'SkillsController@show');
Route::post('skills/update', 'SkillsController@update');
Route::get('skills/delete/{id}', 'SkillsController@destroy');

/*Skills*/


/*Classes Search*/

Route::get('classes', 'DateClassController@index');
Route::get('/search', 'DateClassController@index');
Route::get ( '/search','DateClassController@search');
Route::post ( 'search','DateClassController@searchdata');
/*
Route::post('/search', 'DateClassController@testsearch');*/

/*Classes Search*/