@extends('layouts.master')

@section('header')
    @if(isset($breed))
        <a href="{{ url('/') }}">Back to overview</a>
    @endif
    <h2>
        All @if (isset($breed)) {{ $breed->name }} @endif Cats
        <a href="{{ url('cats/create') }}" class="btn btn-primary pull-right">Add a new cat</a>
    </h2>
@endsection
@section('content')
    <!-- Cart-->
    <div class="cart-info">
        <h1>Giỏ hàng: Tổng tiền {{ $subtotal }} VND</h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th class="name">Cat Name</th>
                <th class="quantity">Qty</th>
                <th class="quantity">Price</th>
                <th class="total">Total</th>

            </tr>
            @foreach($cart as $item)
            <tr>
                <td class="name"><a href="{{ url('cats/' . $item->id) }}">{{ $item->name }}</a></td>
                <td class="name">{{ $item->qty }}</td>
                <td class="price">{{ Furbook\Helpers\Common::formatCurrency($item->price) }} VND</td>
                <td class="total">{{ Furbook\Helpers\Common::formatCurrency($item->subtotal) }} VND</td>
            </tr>
            @endforeach
        </table>
    </div>
    @foreach($cats as $cat)
        <div class="cat">
            <a href="{{ url('cats/' . $cat->id) }}">
                <strong>{{ $cat->name }}</strong> -
                {{ $cat->breed->name }}
            </a>
            <a href="{{ route('cart.add', $cat->id) }}">
              <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
        </div>
    @endforeach
@endsection