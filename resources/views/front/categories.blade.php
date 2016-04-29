@extends('layouts.master')

@section('title', $title)

@section('content')
@foreach($categories as $category)

<h3>{{ $category->title }}</h3>

@endforeach

@stop

@section('sidebar')
    <a href=""></a>
@stop