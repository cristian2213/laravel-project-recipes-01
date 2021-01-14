<?php

use Illuminate\Support\Facades\Auth;
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

//* ******************** Rutas recetas ************************
Route::get('/', 'InicioController@index')->name('inicio.index');

Route::get('/recetas', 'RecetaController@index')->name('recetas.index'); // show recipes

Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create'); // create a new recipe

Route::post('/recetas', 'RecetaController@store')->name('recetas.store'); // save new recipe

Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show'); // show an only recipe

Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit'); // show view edit

Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update'); // update recipe

Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy'); // delete recipe

// manejar rutas simplificada en un solo recurso
//Route::resource('recetas', 'RecetaController');

//* ******************** Rutas Perfil *******************
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');

Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');

Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');

Auth::routes();

//******************* Ruta like ***********************
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.store');

// Route::get('/home', 'HomeController@index')->name('home');
