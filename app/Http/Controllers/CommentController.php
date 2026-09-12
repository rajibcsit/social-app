<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data=$request->validate(['body'=>'required|string|max:1000']);
        $post->comments()->create(['body'=>$data['body'],'user_id'=>$request->user()->id]);
        return back();
    }

    public function destroy(Request $request, Comment $comment)
    {
        abort_unless($comment->user_id === $request->user()->id,403);
        $comment->delete();
        return back();
    }
}
