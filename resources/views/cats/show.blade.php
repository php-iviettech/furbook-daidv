@extends('layouts.master')

@section('header')
    @if(isset($breed))
        <a href="{{ url('/') }}">Back to overview</a>
    @endif
    <h2>
        {{ $cat->name }}
    </h2>
    <a href="{{ url('cats/'.$cat->id . '/edit') }}"><span class="glyphicon glyphicon-edit"></span>Edit</a>
    <a href="{{ url('cats/'.$cat->id . '/delete') }}"><span class="glyphicon glyphicon-trash"></span>Delete</a>
    <p>Last edited: {{-- $cat->update_at->diffForHumans() --}}</p>
@endsection
@section('content')
    <p>Date of Birth: {{ $cat->date_of_birth }}</p>
    <p>
        @if($cat->breed)
            Breed: <a href="{{ url('cats/breeds/' . $cat->breed->name)}}">{{ $cat->breed->name }}</a>
        @endif
    </p>
@endsection