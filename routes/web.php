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
    return view('home');
});

Route::get('insertionBD', function () {
    return view('home');
})->name('insertionBD');

Route::get('afficheTransaction', 'TransactionController@afficheTransaction')->name('afficheTransaction');

Route::get('bonus', function() {
    return view('home');
})->name('bonus');