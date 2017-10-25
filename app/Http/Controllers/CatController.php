<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Furbook\User;
use Furbook\Role;
use Furbook\Cat;
use Furbook\Breed;
use Furbook\Post;
use Furbook\Article;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $use = User::create([
            'name' => 'Model event',
            'email' => 'model.event@gmail.com',
            'password' => '123456',
        ]);

        dd($use);
        /*
        $article = Article::with('images')->find(1);
        dd($article->images);
        $post = Post::with('images')->find(1);
        dd($post->images);
        
        //Saving data method firstOrCreate
        $cat = Cat::firstOrCreate([
            'name' => 'Tom firstOrCreate',
            'date_of_birth' => date('Y-m-d'),
            'breed_id' => 1,
            'description' => 'Meo tom firstOrCreate'
        ]);
        dd($cat);
        //Saving data by model instance
        $cat = Cat::find(1);
        $cat->name = 'Tom model instance';
        $cat->description = 'Meo tom model instance';
        $cat->save();
        dd($cat);
        //Saving data method create
        $cat = Cat::create([
            'name' => 'Tom create',
            'date_of_birth' => date('Y-m-d'),
            'breed_id' => 1,
            'description' => 'Meo tom create'
        ]);
        dd($cat);
        //Saving data method update
        $cat = Cat::find(1);
        $cat->update([
            'name' => 'Tom create',
            'date_of_birth' => date('Y-m-d'),
            'breed_id' => 1,
            'description' => 'Meo tom create'
        ]);
        dd($cat);
        //Saving data method insert
        $cat = Cat::insert([
            'name' => 'Tom insert',
            'date_of_birth' => date('Y-m-d'),
            'breed_id' => 1,
            'description' => 'Meo tom insert'
        ]);
        dd($cat);
        //retieving data
        $cat = Cat::find(1);
        */
        
        $cats = Cat::all();
        return view('cats.index')->with('cats', $cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = Cat::create($request->all());
        return redirect('cats/'.$cat->id)
            ->withSuccess('Cat has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Cat::find($id);
        return view('cats.show') ->with('cat', $cat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        if(!Auth::user()->canEdit($cat)){
            return redirect()->route('login');
        }
        return view('cats.edit')->with('cat', $cat);
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
        Cat::where('id', $id)->update([
            'name' => $request->input('name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'breed_id' => $request->input('breed_id')
        ]);
        return redirect('cats/'. $id)
            ->withSuccess('Cat has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cat::where('id', $id)->delete();
        return redirect('cats')
            ->withSuccess('Cat has been deleted.');
    }
}