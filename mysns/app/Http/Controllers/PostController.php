<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Like;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('reply_post_id', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $replies = Post::where('reply_post_id', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $users = User::all();
        $likes = [];

        foreach ($posts as $post) {
            $likes[] = $post
                ->likes()
                ->where('user_id', Auth::user()->id)
                ->get();
        }

        foreach ($replies as $reply) {
            $likes[] = $reply
                ->likes()
                ->where('user_id', Auth::user()->id)
                ->get();
        }

        $count = count($likes);

        // dd($likes);

        return view('posts.index', compact(
            'posts', 'replies', 'users', 'likes', 'count'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($reply_post_id)
    {
        $posts = Post::where('reply_post_id', 0)->get();
        $redirect = true;

        foreach ($posts as $post) {
            if ($post->id == $reply_post_id) {
                $redirect = false;
            }
            if ($reply_post_id == 0) {
                $redirect = false;
            }
        }

        if ($redirect) {
            return redirect()->route('posts.index');
        }

        $exist_likes_count = false;
        session(['reply_post_id' => $reply_post_id]);

        return view('posts.create', compact('reply_post_id', 'exist_likes_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'body' => 'required|min:3',
          'user_id' => 'required|numeric|size:' . Auth::id(),
          'reply_post_id' => 'integer|size:' . session('reply_post_id'),
        ];

        $validated = $this->validate($request, $rules);

        Post::create($validated);

        session()->forget('reply_post_id');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);
        $replies = Post::where('reply_post_id', $post_id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $users = User::all();
        $likes = [];

        $likes[] = $post
            ->likes()
            ->where('user_id', Auth::user()->id)
            ->get();

        foreach ($replies as $reply) {
            $likes[] = $reply
                ->likes()
                ->where('user_id', Auth::user()->id)
                ->get();
        }

        $count = count($likes);

        // dd($likes);

        return view('posts.show', compact('post', 'replies', 'users', 'likes', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);

        if ($post->user_id != Auth::id()) {
            return redirect()->route('posts.index');
        }

        $exist_likes_count = true;
        session(['post_id', $post_id]);

        return view('posts.edit', compact('post', 'exist_likes_count'));
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

      $rules = [
        'body' => 'required|min:3',
        'user_id' => 'required|numeric|size:' . $post->user_id,
        'reply_post_id' => 'required|numeric|size:' . $post->reply_post_id,
        'likes_count' => 'required|numeric|size:' . $post->likes_count,
      ];

      $validated = $this->validate($request, $rules);
      $post->update($validated);

      session()->forget('post_id');

      return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index')->with('message', 'Deleted Post!');
    }
}
