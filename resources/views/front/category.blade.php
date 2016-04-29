@extends('layouts.master')

@section('title', $title)

@section('content')
<h1>{{ $category->title }}</h1>
<p>{{ $category->excerpt }}</p>

@foreach($category->posts as $post)

<div class="cat">
    <a href="{{url('article',[$post->id])}}" class=""><h3>{{$post->title}}</h3>

             @if($picture = $post->picture)
            <div>
                 <img class="img-reponsive" src="{{url('uploads', $post->picture->uri)}}">
            </div>
            @endif
    </a>
</div>
@endforeach

@endsection

