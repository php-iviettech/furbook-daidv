<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// sử dụng talend API Tester hoặc postman để test
// Method=GET, URI=http://localhost:8000/api/user?api_token=xxx
// hoặc HEADERS name="Authorization" value="Bearer [users.api_token]"
// Method=GET, URI=http://localhost:8000/api/user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ko sử dụng auth nên ko cần Headers
Route::prefix('v1')->group(function () {
    Route::resource('categories', 'CategoryController');
});
