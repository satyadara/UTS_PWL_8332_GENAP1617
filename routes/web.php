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
    return redirect('/home');
});

Auth::routes();

//SHOW PAGE
Route::get('/home', 'WhatController@index');
	//KATEGORI
Route::get('/Kategori/{id_kategori}', 'WhatController@kategori');
Route::get('/tambahkategori/', 'HomeController@tambahkategori');
Route::get('/perbaruikategori/{id_kategori}', 'HomeController@perbaruikategori');
	//TOPIK
Route::get('/Topik/{id_topik}', 'WhatController@tampilTopik');
Route::get('/tambahtopik/{id_kategori}', 'HomeController@tambahtopik');
Route::get('/PerbaruiTopik/{id_topik}', 'HomeController@topik');
	//KOMENTAR
Route::get('/Topik/{id_topik}/{id_komentar}', 'HomeController@komentar');
////////////////////////////////////////////////////////////////////////////////////////

//STORE
Route::post('/storekategori', 'HomeController@storeKategori');
Route::post('/storetopik/{nama_kategori}', 'HomeController@storeTopik');
Route::post('/storeKehadiran/{id_topik}', 'HomeController@storeKehadiran');
Route::post('/komentar/{id_topik}', 'HomeController@storeKomentar');

//UPDATE
Route::put('/updatekomentar/{id_topik}/{id_komentar}', 'HomeController@updatekomentar');
Route::put('/updatetopik/{id_topik}', 'HomeController@updatetopik');
Route::put('/updatekategori/{id_kategori}', 'HomeController@updatekategori');

//DELETE
Route::get('/hapuskategori/{id_kategori}', 'HomeController@deletekategori');
Route::get('/deletetopik/{id_topik}', 'HomeController@deletetopik');
Route::get('/deletekomentar/{id_topik}/{id_komentar}', 'HomeController@deletekomentar');



//PENCARIAN
Route::get('/mencari/topik', 'WhatController@pencarian');

//PROFILE
Route::get('profil', 'HomeController@getProfil');
Route::put('updateprofil', 'HomeController@updateProfil');
