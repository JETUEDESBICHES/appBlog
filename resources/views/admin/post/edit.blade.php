@extends('layouts.admin')

@section('content')

	@if(Session::has('message'))
		<p>{{Session::get('message')}}</p>
	@endif

	<form action="{{url('post', $post->id)}}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PATCH">
		{{csrf_field()}}
		<p>
			<label>Titre</label>
			<input type="text" name="title" value="{{$post->title}}">
		</p>
		<label>Contenu</label>
		@if($errors->has('title')) <span class="error">{{$errors->first('title')}}@endif
			<textarea name="content">{{$post->content}}</textarea>
			@if($errors->has('content')) <span class="error">{{$errors->first('content')}}@endif
				<div class="form-select">
					<label for="category_id">Catégorie</label>
					<select name="category_id">
						@foreach( $categories as $id=>$title )
							<option {{$post->category_id==$id? 'selected' : ''}} value="{{$id}}">{{$title}}</option>
						@endforeach
						<option {{is_null($post->category_id)? 'selected' : ''}} value="0">Non catégorisé</option>
					</select>
				</div>

	<div class="form-group">
		@if(!is_null($post->picture))
		<img src="{{url('uploads', $post->picture->uri)}}"> 
		@endif
	  	@if($errors->has('picture')) {{ $errors->first('picture') }} @endif
	  	<input type="file" name="picture" >
	  	<label for="name">titre de l'image</label><input type="text" name="name">
	  	<label for="delete" >Suprimer l'image</label><input type="checkbox" name="deletepicture">oui
	</div>

     <div class="form-select">
		 <label for="tag_id">Mot clé</label>
		 <select name="tag_id[]" multiple>
			 @foreach( $tags as $id => $name )
				 <option @if($post->hasTag($id)) selected @endif value="{{$id}}">{{$name}}</option>
			 @endforeach
		 </select>
	 </div>



    <p><input type="submit" value="ok"></p>
	</form>
@endsection