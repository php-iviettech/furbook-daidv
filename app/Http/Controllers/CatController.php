<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Furbook\Helpers\Common;
use Furbook\Http\Requests\CatRequest;
use Auth;
use Furbook\Cat;
use Validator;
use Cart;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Saving data method firstOrCreate
        // Saving data method create
        // Saving data method update

        // Saving data by model instance
        // Saving data method insert

        //Giá tiền chuyển đổi sang kiểu decimal
        //dd(Cart::subtotal(0, '.', ''));
        $cart = Cart::content();
        $subtotal = Cart::subtotal(0, '.', ',');

        // Define per page
        $perPage = 5;
        $cats = Cat::orderBy('created_at', 'DESC')->paginate($perPage);
        // Check request is ajax
        if ($request->ajax()) {
            return view('partials.cat')->with('cats', $cats);
        }
        // Request not ajax
        return view('cats.index', compact('cats', 'cart', 'subtotal'));
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
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:cats,name',
            'date_of_birth' => 'required|date_format:"Y-m-d"',
            'price' => 'required|currency_size:1,8|regex:/^(\d{1,3})?+(?:\,[0-9]{3})?+(?:\,[0-9]{3})?$/',
            'breed_id' => 'required|numeric',
        ],
        [
            'required' => 'Trường :attribute là bắt buộc.',
            'unique' => 'Trường :attribute đã bị trùng.',
            'numeric' => 'Trường :attribute phải là kiểu số.',
            'date_format' => 'Trường :attribute định dạng chưa đúng kiểu "Y-m-d"',
            'regex' => 'Trường :attribute định dạng không đúng.',
            'currency_size' => 'Trường :attribute độ dài phải lớn hơn :min và nhỏ hơn :max.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('cats.create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_id = Auth::user()->id;
        $request->request->add(['user_id' => $user_id]);
        //dd($request->all());
        $cat = Cat::create($request->all());
        return redirect()
            ->route('cats.show', $cat->id)
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
        return view('cats.show')->with('cat', $cat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        return view('cats.edit')->with('cat', $cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Furbook\Http\Requests\CatRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatRequest $request, Cat $cat)
    {
        $cat->update([
            'name' => $request->input('name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'price' => $request->input('price'),
            'breed_id' => $request->input('breed_id')
        ]);
        return redirect()
            ->route('cats.show', $cat->id)
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
        return redirect()
            ->route('cats.index')
            ->withSuccess('Cat has been deleted.');
    }

    public function addCart(Cat $cat)
    {
        Cart::add([
            'id' => $cat->id,
            'name' => $cat->name,
            'qty' => 1,
            'price' => Common::convertDecimal($cat->price)
        ]);
        return redirect()->route('cats.index');
    }
}