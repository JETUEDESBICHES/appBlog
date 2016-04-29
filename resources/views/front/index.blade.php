@extends('layouts.master')

@section('title', $title)

@section('content')


    {{ $posts->links() }}
    @forelse($posts as $post)
    <div class="article">
    
        <h1><a href="{{url('article',[$post->id])}}" class="">{{$post->title}}</a></h1>

         @if($picture = $post->picture)
        <div class="image">
             <img class="img-reponsive" src="{{url('uploads', $post->picture->uri)}}">
        </div>
        @endif
        
        
        @if($post->content)
            <p>{{ $post->excerpt(10) }}<a href="{{url('article',[$post->id])}}">Voir la suite</a></p>
        @else
            <p>pas de texte à l'article</p>
        @endif
        
        

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
        
        

        @if(!is_null($post->user))
            <p> <h4>Auteur</h4> <a href="{{action('FrontController@showPostByUser', [$post->user->id])}}">{{$post->user->name}}</a></p>
        @else
            <p>pas d'auteur</p>
        @endif
        
       
        
       <h4>Tags</h4>
       <ul>
        @forelse($post->tags as $tag)
            
            <li class="tag">{{$tag->name}}</li>
        @empty

        @endforelse
        </ul>
        
        <p class="date">{{ $post->published_at }}</p>



</div>


        

    @empty
  
    @endforelse

    {{ $posts->links() }}
@stop

@section('sidebar')
    <h3>Sponsor</h3>
    <img style="width: 30%" src="http://www.cognix-systems.com/scripts/files/56659c8a295a92.74808223/05007000-photo-logo-php-elephpant.jpg">


@stop