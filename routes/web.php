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
    $corp1 = 'Iviettech';
    $corp2 = 'Iviettech';
    $corp3 = 'Iviettech';
    //return view('about', ['corp'=> $corp]);
//    return view('about')->with('corp1', $corp1)
//        ->with('corp2', $corp2)
//        ->with('corp3', $corp3);
    return view('about', compact('corp1', 'corp2', 'corp3'));
});

Route::get('/cats/breeds/{name}', function ($name) {
    $breed = Furbook\Breed::with('cats')
    ->whereName($name)
    ->first();
    //dd($breed);
    return view('cats.index')
        ->with('breed', $breed)
        ->with('cats', $breed->cats);
});

Route::get('/cats/{id}', function ($id) {
    $cat = Furbook\Cat::find($id);
    //dd($cat);
    return view('cats.show')
        ->with('cat', $cat);
});
Route::get('/test', function () {
    dd(Furbook\Breed::all()->pluck('id', 'name'));
    //return view('partials.forms.cat');
});