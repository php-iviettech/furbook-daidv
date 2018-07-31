@extends('layouts.master')
@section('header')
    <a href="{{ url('/cats') }}">Back to overview</a>
    <h2>
    {{ $cat->name }}
    </h2>
    <a href="{{ url('cats/'.$cat->id.'/edit') }}" class="btn btn-primary pull-left" style="margin-right: 10px;">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <form action="{{ url('cats/'.$cat->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
            Delete
        </button>
    </form>
    <p>Last edited: {{$cat->updated_at->diffForHumans()}}</p>
@stop
@section('content')
    <p>Date of Birth: {{ $cat->date_of_birth }}</p>
    <p>
        @if ($cat->breed)
            Breed:
            {{ link_to('cats/breeds/'.$cat->breed->name,
            $cat->breed->name) }}
        @endif
    </p>
@stop