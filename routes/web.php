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

Route::get('/home', 'Site\HomeController@index');

Route::get('/sair', 'Auth\LoginController@logout');

Route::get('/buscarCidades/{id}', 'Auth\RegisterController@getCidades');

Route::get('/livros', 'Dashboard\LivroController@index');
Route::post('/livros', 'Dashboard\LivroController@salvar');
Route::get('/livros/{id}', 'Dashboard\LivroController@mostrarFormAlterarLivro');
Route::post('/alterarLivro', 'Dashboard\LivroController@alterar');
Route::get('/deletaCapa/{id}', 'Dashboard\LivroController@deletaCapa');
Route::post('/alterar', 'Dashboard\LivroController@alterar');
Route::get('/excluir/{id}', 'Dashboard\LivroController@excluir');
Route::get('/livro/{id}', 'Dashboard\LivroController@mostrarFormVerLivro');


// Authentication Routes...
$this->get('login', 'Auth\LoginController@mostraFormLogin')->name('login');
$this->post('login', 'Auth\LoginController@logar');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@mostraFormRegistrar')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
