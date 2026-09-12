<?php
namespace App\Http\Controllers;
use App\Models\Post; use App\Models\SavedPost; use Illuminate\Http\Request;
class SavedPostController extends Controller { public function index(Request $r){$posts=SavedPost::with('post.user','post.comments.user')->where('user_id',$r->user()->id)->latest()->paginate(10);return view('saved.index',compact('posts'));} public function toggle(Request $r,Post $post){$s=SavedPost::where('user_id',$r->user()->id)->where('post_id',$post->id)->first();$s?$s->delete():SavedPost::create(['user_id'=>$r->user()->id,'post_id'=>$post->id]);return back();} }
