<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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


Route::get('/', function () {
    if(Auth::check()){
        return view('main.auth.home');
    }else{
        return view('main.ano.home');
    }

})->name('home');

Auth::routes();

Route::get('/logout', function() {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
});


/**
 * Pages
 */

Route::middleware('auth')->group(function(){
    /**
     * Nécessite l'authentification
     * Le Route::ressource gère toutes les routes présentes dans un controller
     */

    Route::resource('page','PageController');
    Route::get('page/{id}/destroy','PageController@destroy')->name('page.destroy.fix');

    Route::get('collections','CollectionController@index')->name('collections');
    Route::resource('collection','CollectionController');

    Route::get('collection/{id}/addPages','CollectionController@addPages')->name('collection.addPages');

    Route::post('collection/{id}/storePages','CollectionController@storePages')->name('collection.storePages');
    Route::post('collection/{id}/deletePages','CollectionController@deletePages')->name('collection.deletePages');

});

