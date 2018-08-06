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
    return view('welcome', compact('name', 'say'));

    //return view('welcome', ['name' => 'tad3', 'say' => '嗨！']);

    // $data = ['name' => 'tad2', 'say' => '嗨！'];
    // return view('welcome', $data);

    // return view('welcome')
    //     ->with('name', 'tad1')
    //     ->with('say', '嗨！');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
