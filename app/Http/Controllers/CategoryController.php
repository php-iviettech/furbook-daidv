<?php

namespace Furbook\Http\Controllers;

use Furbook\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $response = [];
        foreach ($categories as $category){
            $response['categories'][] = [
                'id' => (int) $category->id,
                'name' => $category->name,
            ];
        }
        
        //Đây là cách chung chung để trả về một phản hồi HTTP.
        //nếu $response là một array hoặc object, laravel tự động gọi json_encode() và trả về JSON.
        //return response($response, 200);//content-type: application/json
        //return response('Hello World', 200);//content-type: text/html
        
        //Đây là cách chuyên dụng để trả về phản hồi JSON.
        //Laravel sẽ tự động đặt header Content-Type: application/json.
        //Dữ liệu $response sẽ được tự động mã hóa JSON.
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data from user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category = Category::create($request->all());
        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        //validate data from user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category->update($request->all());
        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if(!$category->delete()){
            return response()->json(null, 500);
        }
        return response()->json(null, 204);
    }
}
