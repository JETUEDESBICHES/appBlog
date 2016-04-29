@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))
        <p type="button" class="btn btn-success okay">{{Session::get('message')}}</p>
    @endif

    {{ $posts->links() }}

    <table class="table">
        <thead>
        <tr>
            <th>Status</th>
            <th>Titre</th>
            <th>Publier le</th>
            <th>Créé le</th>
            <th>Picture</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Publier</th>
            <th>Editer</th>
            <th>Action</th>
        </tr>
        </thead>
        
        
        @forelse($posts as $post)
           
            <tr class="bg">

                <td>@if($post->status==="opened")
                        <img style="width: 44%" src="{{asset('assets/button-green.png')}}">
                    @endif

                    @if($post->status==="closed")
                    <img style="width: 44%" src="{{asset('assets/button-red.png')}}">
                    @endif</td>

                <td><a href="{{url('post',[$post->id, 'edit'])}}" class="">{{$post->title}}</a></td>
                <td>{{$post->published_at? $post->published_at : 'Non daté'}}</td>
                <td>{{$post->created_at? $post->created_at : 'Non daté'}}</td>
                <td>
                    @if($picture = $post->picture)
                 <a href="{{url('post',[$post->id, 'edit'])}}" class=""><img style="width:80%" src="{{url('uploads', $post->picture->uri)}}"> </a>
                    @endif
                </td>
                <td>
                    @if(!is_null($post->category))
                       <ul>
                        <li>{{$post->category->title}}</li>
                        </ul>
                    @else
                        Non catégorisé
                    @endif
                </td>
                <td>
                   <ul>
                    @forelse($post->tags as $tag)
                        <li class="tag">{{$tag->name}}</li>
                    @empty
                        aucun tag
                    @endforelse
                  </ul>
                </td>
                
                <td>
                 
                    <a href="{{ action('PostController@published', $post)}}" >
                        @if($post->status === 'opened')
                            <div class="btn btn-danger">NON</div>
                        @else
                            <div class="btn btn-success">OUI</div>
                        @endif
                    </a>
                </td>

                <td>
                    <a href="{{url('post',[$post->id, 'edit'])}}" class="btn btn-warning">EDITER</a>

                </td>

                <td>
                   
                  
                    <form class="destroy" method="POST" action="{{url('post', $post->id)}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="title_h" value="{{$post->title}}">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">supprimer</button>
                    </form>
                   
                </td>
                
            </tr>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Voulez vous supprimer le post ?</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('post', $post->id)}}" method="POST" >
                                <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger" value="delete" >Oui !</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Non !</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            
        @empty
            <p>Aucun article en base</p>
        @endforelse
        
    </table>
    




@endsection