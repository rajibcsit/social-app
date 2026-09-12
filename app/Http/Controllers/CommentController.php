<?php
namespace App\Http\Controllers;
use App\Models\Comment; use App\Models\Post; use App\Notifications\SocialNotification; use Illuminate\Http\Request;
class CommentController extends Controller { public function store(Request $r,Post $post){$data=$r->validate(['body'=>'required|string|max:1000']);$post->comments()->create(['body'=>$data['body'],'user_id'=>$r->user()->id]);if($post->user_id!==$r->user()->id)$post->user->notify(new SocialNotification($r->user()->name.' commented on your post.',route('feed')));return back();} public function destroy(Request $r,Comment $comment){abort_unless($comment->user_id===$r->user()->id,403);$comment->delete();return back();} }
