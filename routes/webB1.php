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
    $name = 'tad4';
    $say  = '嗨！';
    return view('/', 'ExamController@index');

    //return view('welcome', ['name' => 'tad3', 'say' => '嗨！']);

    // $data = ['name' => 'tad2', 'say' => '嗨！'];
    // return view('welcome', $data);

    // return view('welcome')
    //     ->with('name', 'tad1')
    //     ->with('say', '嗨！');
});

Auth::routes();

Route::get('/home', 'ExamController@index')->name('home');

// Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/exam/create', function () {
//     return view('exam.create');
// })->name('exam.create');

Route::get('/exam/create', 'ExamController@create')->name('exam.create');
Route::get('/exam', 'ExamController@index')->name('exam.index');
Route::post('/exam', 'ExamController@store')->name('exam.store');
