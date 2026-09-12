<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $like = Like::where('post_id',$post->id)->where('user_id',$request->user()->id)->first();
        $like ? $like->delete() : Like::create(['post_id'=>$post->id,'user_id'=>$request->user()->id]);
        return back();
    }
}
