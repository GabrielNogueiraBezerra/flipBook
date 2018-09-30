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
Route::get('/pesquisa', 'Site\HomeController@pesquisa');

Route::get('/home', 'Site\HomeController@index');



// Livro Routes...
Route::get('/livros', 'Dashboard\LivroController@index');
Route::post('/livros', 'Dashboard\LivroController@salvar');
Route::get('/livros/{id}', 'Dashboard\LivroController@mostrarFormAlterarLivro');
Route::post('/alterarLivro', 'Dashboard\LivroController@alterar');
Route::get('/deletaCapa/{id}', 'Dashboard\LivroController@deletaCapa');
Route::post('/alterar', 'Dashboard\LivroController@alterar');
Route::get('/excluir/{id}', 'Dashboard\LivroController@excluir');
Route::get('/livro/{id}', 'Dashboard\LivroController@mostrarFormVerLivro');
Route::get('/livros/buscar/livros', 'Dashboard\LivroController@pesquisa');

// Compra Routes...
Route::get('/areaCompras', 'Dashboard\AreaCompraController@index');
Route::get('/areaCompras/pesquisa', 'Dashboard\AreaCompraController@pesquisa');

// Venda routes...
Route::get('/areaVendas', 'Dashboard\AreaVendasController@index');
Route::get('/areaVendas/pesquisa', 'Dashboard\AreaVendasController@pesquisa');

// Compra Livro routes...
Route::get('/compraLivro/{id}', 'Site\CompraLivro@index');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@mostraFormLogin')->name('login');
$this->post('login', 'Auth\LoginController@logar');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/sair', 'Auth\LoginController@logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@mostraFormRegistrar')->name('register');
$this->post('register', 'Auth\RegisterController@register');
Route::get('/buscarCidades/{id}', 'Auth\RegisterController@getCidades');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
