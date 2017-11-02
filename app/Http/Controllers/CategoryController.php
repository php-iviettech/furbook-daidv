<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Furbook\Category;
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
        $response = [
            'categories' => []
        ];
        $categories = Category::all();
        foreach ($categories as $category){
            $response['categories'][] = [
                'id' => (int) $category->id,
                'name' => $category->name
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category = Category::create($request->all());
        $response = [
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ]
        ];
        return response()->json($response, 201);

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
    {dd($request->all());
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category->update($request->all());
        $response = [
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ]
        ];
        return response()->json($response, 200);
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
