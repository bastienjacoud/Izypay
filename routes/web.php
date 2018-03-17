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


/**
 * Route vers la page principale (home)
 */
Route::get('/', function () {
    return view('home');
});


/**
 * Route allant vers la fonction d'affichage du formulaire de l'exercice principal
 */
Route::get('afficheTransaction', 'TransactionController@afficheFormTransaction')->name('afficheTransaction');


/**
 * Route allant vers la fonction d'affichage du résultat de l'exercice principal
 */
Route::post('listerAffichage', 'TransactionController@afficheTransaction')->name('listerAffichage');


/**
 * Route allant vers la fonction d'affichage du formulaire de l'exerice bonus
 */
Route::get('listerBonus', 'BilletController@afficheFormBillet')->name('listerBonus');


/**
 * Route allant vers la fonction d'affichage du résultat de l'exercice bonus
 */
Route::post('bonus', 'BilletController@afficheTabBillets')->name('bonus');


/**
 * Route allant vers la fonction de download du fichier de résultat
 */
Route::get('download', 'BilletController@download')->name('download');