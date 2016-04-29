@extends('layouts.master')

@section('title', $title)

@section('content')
<h1>{{ $post->title }}</h1>
@if($picture = $post->picture)
    <div class="image">
        <img class="img-reponsive" src="{{url('uploads', $post->picture->uri)}}">
    </div>
@endif
<p>{{ $post->content }}</p>

@if(!is_null($post->category))
    <p><h4>catégorie</h4>
    <ul>
        <li>
            {{$post->category->title}}
        </li>
    </ul>
    </p>
@else
    <p>Pas de catégorie associée pour cette article</p>
@endif

<h4>Tags</h4>
<ul>
    @forelse($post->tags as $tag)

        <li class="tag">{{$tag->name}}</li>
    @empty

    @endforelse
</ul>

<p class="italic">Crée le {{ $post->date() }} par {{ $post->user->name }}</p>
@endsection

