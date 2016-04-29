@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif

    <form method="POST" action="{{url('post')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$userId}}">


        <fieldset class="form-group">
            <label>Titre</label>@if($errors->has('title')) <span class="error">{{$errors->first('title')}}</div>@endif
            <input class="form-control" type="text" name="title" value="{{old('title')}}">
        </fieldset>

        <fieldset class="form-group">
        <label>Contenu</label>@if($errors->has('content')) <span class="error">{{$errors->first('content')}}@endif
            <textarea class="form-control" name="content">{{old('content')}}</textarea>
        </fieldset>

        <fieldset class="form-group">
            <label>Sélectionner une catégorie</label>
                <select class="form-control" name="category_id">
                    @forelse($categories as $id=>$title)
                        <option value="{{$id}}">{{$title}}</option>
                    @empty
                    @endforelse
                    <option value="0" selected>non catégorisé</option>
         </select>
        </fieldset>
        
 <div class="col-md-4">
          <fieldset class="form-group">
            <label for="name">Choirsir son image</label>
            <input type="file" name="picture">
            
            @if($errors->has('picture'))
                <span class="error">{{ $errors->first('picture') }}</span>
            @endif
         </fieldset>
  </div>
  <div class="col-md-4">
           <fieldset class="form-group">
            <label for="name">Titre de l'image</label>
            <input type="text" name="name">
            @if($errors->has('name'))
                <span class="btn btn-danger">{{ $errors->first('name') }}</span>
            @endif 
        </fieldset>
   </div>

        


<div class="col-md-4">
        <fieldset class="form-group">
        <div class="form-select">
            <label for="tags">Choisir un/des tags</label></p>
                <select name="tag_id[]" multiple>
                    @foreach($tags as $id => $name)
                        <option value="{{$id}}">{{$name}} </option>
                    @endforeach
            </select>
            @if($errors->has('tags')) <div class="btn btn-danger">{{ $errors->first('tags') }}</div> @endif
        
        </div>
        </fieldset>
</div>



        <button type="submit" class="btn col-md-12 btn-primary">Valider</button>


    </form>
@endsection