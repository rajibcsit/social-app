<?php
namespace App\Http\Controllers;
use App\Models\Like; use App\Models\Post; use App\Notifications\SocialNotification; use Illuminate\Http\Request;
class LikeController extends Controller { public function toggle(Request $r,Post $post){$like=Like::where('post_id',$post->id)->where('user_id',$r->user()->id)->first();if($like)$like->delete();else{Like::create(['post_id'=>$post->id,'user_id'=>$r->user()->id]);if($post->user_id!==$r->user()->id)$post->user->notify(new SocialNotification($r->user()->name.' liked your post.',route('feed')));}return back();} }
