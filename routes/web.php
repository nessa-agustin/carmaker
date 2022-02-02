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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(CarController::class)->group(function(){

    Route::get('/carmaker','create');
    Route::get('/carmaker/list','index');
    Route::post('/carmaker','store');
    Route::get('/carmaker/{id}','show');



});

Route::controller(ManufacturerController::class)->group(function(){

    Route::get('/manufacturer/list','index');
    Route::post('/manufacturer','store');
    Route::delete('/manufacturer/{id}','destroy');


});