<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Following;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AllUsersPostsShow()
    {
        $posts = Post::all();
        return view('posts.AllUsersPostsShow', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:140','min:1'],
            'content' => ['required','max:140','min:1'],
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        if(null!=($request->file('image_file'))){
        $imageFilePath = $request->file('image_file')->store('public');
        $post->image_file = basename($imageFilePath);
        };
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect("/mypage/{$post->user_id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $response = Gate::inspect('view',$post);
        
        if($response->allowed())
        {
            return view('posts.show', [
                'post' => $post,
            ]);
        } else {
            abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $response = Gate::inspect('view',$post);
        
        if($response->allowed())
        {
            return view('posts.edit', [
                'post' => $post,
            ]);
        } else {
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        $validateRule = [
            'title' => 'required|max:140|min:1',
            'content' => 'required|max:140|min:1',
        ];
        $this -> validate($request, $validateRule);

        $post->title = $request->title;
        $post->content = $request->content;
        $imageFilePath = $request->file('image_file')->store('public');
        $post->image_file = basename($imageFilePath);
        $post->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
    
        return redirect()->route('posts.show');
    }


    public function followUserPosts(Request $request,Post $post,Following $following)
    {
        $LoginUser = $request -> user();
        $LoginUserId = $LoginUser -> id;

        $followListId = $following -> getFollowListId($LoginUserId);
        if($followListId -> isEmpty() )
        {
            abort(404);
        } 

        $followUserPosts = $post -> getFollowUserPosts($followListId);
        if($followUserPosts -> isEmpty() )
        {
            abort(404);
        }

        return view('posts.followUserPosts', [
            'followUserPosts' => $followUserPosts,
        ]);
    }
}
