<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Like;
use Auth;
use App\Post;

class LikesController extends Controller
{
    public function store(Request $request, $post_id)
    {
        Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id
        ]);

        $post = Post::findOrFail($post_id);

        return redirect()->route('posts.index');
    }

    public function destroy($post_id, $like_id)
    {
        $post = Post::findOrFail($post_id);
        $post->like_by()->findOrFail($like_id)->delete();
        $post_id = $post->id;

        return redirect()->route('posts.index');
    }
}
