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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['reset' => false]);

// Utilisateur
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('/reset', 'UserController@resetPassword')->name('reset');
Route::post('/reset', 'UserController@resetPassword')->name('postreset');
Route::get('/saison/{saisonId}', 'UserController@showUserSaison')->name('user.saison');

Route::resource('user', 'UserController');
Route::get('/user/{user}/confirmation', 'UserController@confirmation')->name('user.confirmation');
Route::post('/user/{user}/status', 'UserController@majStatus')->name('user.maj');

Route::get('/reglement/{user}/create', 'ReglementController@create')->name('reglement.create');
Route::get('/reglement/{user}/{reglement}/edit', 'ReglementController@edit')->name('reglement.edit');
Route::resource('reglement', 'ReglementController')->except(['create','edit']);

