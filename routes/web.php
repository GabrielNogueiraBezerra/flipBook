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

Route::get('/', 'Site\HomeController@index');

Route::get('/teste', 'Site\HomeController@teste');

Route::get('/home', 'Site\HomeController@index');

Route::get('/sair', 'Auth\LoginController@logout');

Auth::routes();
Route::get('/buscarCidades/{id}', 'Auth\RegisterController@getCidades');

Route::get('/livros', 'Dashboard\LivroController@index');
Route::post('/livros', 'Dashboard\LivroController@salvar');
