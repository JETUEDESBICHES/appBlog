<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Picture;
use Auth;
use File;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
        // dd($posts);
        // $posts = Post::orderBy('title','desc')->with('category','user','tags');
        $posts = Post::with('category', 'tags', 'user')->orderBy('created_at','DESC')->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists( 'title', 'id'); // collection tableau
        $tags = Tag::lists('name', 'id');
        $userId = Auth::user()->id;

        return view('admin.post.create', compact('categories','tags','userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        
        $post = Post::create($request->all());

        //dd($request->all());

        if(!empty($request->file('picture')))
        {
            $im = $request->file('picture');

            $ext = $im->getClientOriginalExtension();//extention du fichiers

            $uri = str_random(50) .'.' . $ext;

            Picture::create([
                'name' =>$request->input('name'),
                'uri' =>$uri,
                'size' =>$im->getSize(),
                'mime' =>$im->getClientMimeType(),
                'post_id' =>$post->id
                ]);
            $im->move(env('UPLOAD_PICTURES','uploads'), $uri);
        }

        if(!empty($request->input('tag_id')))
            $post->tags()->attach($request->input('tag_id'));

        return redirect('post')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::lists( 'title', 'id'); // collection tableau
        $tags = Tag::lists('name', 'id');

        return view('admin.post.edit', compact('post', 'categories', 'tags')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
            $post->update($request->all());

        if(!empty($request->file('picture'))) {
                    // dd($request->file('picture'));
            if($post->picture) {

                $picture = Picture::findOrFail($post->picture->id);
                $picture->delete();

                $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $post->picture->uri;
        
        if(File::exists($fileName))
            File::delete($fileName);
 
            }

            $im = $request->file('picture');

            $ext = $im->getClientOriginalExtension();//extention du fichiers

            $uri = str_random(50) .'.' . $ext;

            Picture::create([
                'name' =>$request->input('name'),
                'uri' =>$uri,
                'size' =>$im->getSize(),
                'mime' =>$im->getClientMimeType(),
                'post_id' =>$post->id
                ]);
            $im->move(env('UPLOAD_PICTURES','uploads'), $uri);
        
        }

        if (!empty($request->input('tag_id')))
            $post->tags()->sync($request->input('tag_id'));

        if(!empty($request->input('deletepicture'))) {
            $picture = Picture::findOrFail($post->picture->id);
                $picture->delete();
            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $post->picture->uri;
        
        if(File::exists($fileName))
            File::delete($fileName);
        }

        return redirect('post')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
       // $post = Post::destroy($id);
        $post = Post::FindOrFail($id);
        $this->deletePicture($post);
        $post->delete();


       return redirect('post')->with('message', 'success'); 
    }
 
 public function published(Post $post) {
        $post->status ==='opened'? $post->status ='closed': $post->status ='opened';
       if( $post->status === 'opened' ){
   
         $post->published_at = Carbon::now(); 
  }
 
        $post->touch();
        return back();
    }
 

    private function deletePicture(Post $post)
    {
        if(!is_null($post->picture))
        {
            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $post->picture->uri;
        
        if(File::exists($fileName))
            File::delete($fileName);

        $post->picture->delete();

        }

    }
}