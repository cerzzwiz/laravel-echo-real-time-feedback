<?php

use App\Element;
use App\Events\ElementCreated;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

// récuperation de la liste des éléments
Route::get('/elements', function () {
    return Element::latest()->pluck('details');
});

// création de nouvel élément
Route::post('/elements', function () {
    $element = Element::forceCreate(request(['details']));

    event(new ElementCreated($element));
});
