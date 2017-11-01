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
    return 'All cats';
});

Route::get('/cats/{id}', function ($id) {
    //return "All cats #${id}";
    return "All cats #$id";
})->where('id', '[0-9]+');

Route::get('/about', function () {
    $corp = 'Iviettech';
    //return view('about', ['corp'=> $corp]);
    //return view('about')->with('corp', $corp);
    return view('about', compact('corp'));
});
//rv