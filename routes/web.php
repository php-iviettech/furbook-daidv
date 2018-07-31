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
    return redirect()->route('cats.index');
});

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

Route::get('/test', function () {
    dd(Furbook\Breed::all()->pluck('id', 'name'));
    //return view('partials.forms.cat');
});

/*
//index
Route::get('cats', function () {
    $cats = Furbook\Cat::all();
    return view('cats.index')->with('cats', $cats);
});

//create
Route::get('cats/create', function () {
    return view('cats.create');
});

//store
Route::post('cats', function () {
    $cat = Furbook\Cat::create(\Input::all());
    return redirect('cats/' . $cat->id)
        ->withSuccess('Cat has been created.');
});

//show
Route::get('cats/{id}', function ($id) {
    $cat = Furbook\Cat::find($id);
    return view('cats.show')->with('cat', $cat);
});

// or Route-model binding
//Route::get('cats/{cat}', function(Furbook\Cat $cat) {
//   return view('cats.show')->with('cat', $cat);
//});

//edit
Route::get('cats/{cat}/edit', function (Furbook\Cat $cat) {
    return view('cats.edit')->with('cat', $cat);
});

//update
Route::put('cats/{cat}', function (Furbook\Cat $cat) {
    $cat->update(Input::all());
    return redirect('cats/' . $cat->id)
        ->withSuccess('Cat has been updated.');
});

//destroy
Route::delete('cats/{cat}', function (Furbook\Cat $cat) {
    $cat->delete();
    return redirect('cats')
        ->withSuccess('Cat has been deleted.');
});
*/
//Breeds
Route::get('cats/breeds/{name}', function ($name) {
    $cart = Cart::content();
    $subtotal = Cart::subtotal(0, '.', ',');
    $breed = Furbook\Breed::with('cats')
        ->whereName($name)
        ->first();
    return view('cats.index')
        ->with('cart', $cart)
        ->with('subtotal', $subtotal)
        ->with('breed', $breed)
        ->with('cats', $breed->cats);
});
//or use Resource controllers
Route::group(['middleware' => ['auth']], function () {
    Route::resource('cats', 'CatController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

View::composer('users.create', function ($view) {
    //dd(Breed::pluck('name', 'id'));
    $view->breeds = \Furbook\Breed::pluck('name', 'id');
});

Route::get('/money', function () {
    return view('money');
});

Route::get('addCart/{cat}', ['as' => 'cart.add', 'uses' => 'CatController@addCart']);

/*
|--------------------------------------------------------------------------
| UPLOAD STORAGE
|--------------------------------------------------------------------------
| Lưu file có 2 trường hợp
| 1. Lưu trong thư mục storage khi người tải file lên là user
| ví dụ ảnh avatars của người dùng...
| 2. Lưu trong thư mục public khi người tải file lên là admin
| ví dụ các file liên quan đến tài nguyên hệ thống như js, css, font, hình ảnh products...
| Ưu điểm: tên file được tự động mã hóa file, được Laravel hỗ trợ nhiều hàm
| Ngoài ra có một số hàm khác ví dụ move(), storageAs()...tuy nhiên ko hỗ trợ mã hóa tên file
*/
Route::get('upload', ['as' => 'upload.index', 'uses' => 'UploadController@index']);
Route::post('upload/avatar', ['as' => 'upload.userAvatar', 'uses' => 'UploadController@uploadAvatar']);
Route::post('upload/product', ['as' => 'upload.productImage', 'uses' => 'UploadController@uploadProduct']);

// Hỗ trợ lấy file trong thư mục storage bằng hàm asset
Route::get('avatars/{filename}', function ($filename) {
    $path = 'avatars/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});

Route::get('delete/user-avatar', ['as' => 'delete.userAvatar', 'uses' => 'UploadController@deleteUserAvatar']);
Route::get('delete/product-image', ['as' => 'delete.productImage', 'uses' => 'UploadController@deleteProductImage']);