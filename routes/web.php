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
//Route::pattern('id', '[0-9]+'); //注意id名稱要一致
Route::pattern('exam', '[0-9]+'); //12-1路由模型綁定
Route::pattern('topic', '[0-9]+');
Route::get('/', 'ExamController@index')->name('index');

Auth::routes();

Route::get('/home', 'ExamController@index')->name('home');
Route::get('/exam', 'ExamController@index')->name('exam.index');
//Route::get('/exam/{id}', 'ExamController@show')->name('exam.show');
Route::get('/exam/{exam}', 'ExamController@show')->name('exam.show'); //12-1路由模型綁定
Route::get('/exam/create', 'ExamController@create')->name('exam.create');
Route::post('/exam', 'ExamController@store')->name('exam.store');
// Route::get('/exam/{id}', 'ExamController@show')->name('exam.show');
//當上行移到/exam/create前時，會將create以為id，而進行錯誤的SQL應改為以下，限制id為數字
//Route::get('/exam/{id}', 'ExamController@show')->name('exam.show')->where('id', '[0-9]+');
//更好的做法是在最上面加pattern
Route::get('/exam/{exam}/edit', 'ExamController@edit')->name('exam.edit');
Route::patch('/exam/{exam}', 'ExamController@update')->name('exam.update');

Route::post('/topic', 'TopicController@store')->name('topic.store');
Route::get('/topic/{topic}/edit', 'TopicController@edit')->name('topic.edit');
Route::patch('/topic/{topic}', 'TopicController@update')->name('topic.update');
