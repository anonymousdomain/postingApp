<?php

namespace App\Http\Controllers;

use  App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware(['auth'])->only(['store','destroy']);
    } 
    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(15);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(){
        return view('posts.show');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'body' => 'required|min:5'
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);
        return back();
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
