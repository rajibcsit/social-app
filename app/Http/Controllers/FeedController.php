<?php
namespace App\Http\Controllers;
use App\Models\Friendship; use App\Models\Post; use App\Models\User; use Illuminate\Http\Request;
class FeedController extends Controller {
 public function index(Request $request){$id=$request->user()->id;$friendIds=Friendship::where('status','accepted')->where(fn($q)=>$q->where('sender_id',$id)->orWhere('receiver_id',$id))->get()->map(fn($f)=>$f->sender_id==$id?$f->receiver_id:$f->sender_id);$posts=Post::with(['user','comments.user'])->withCount('likes')->where(fn($q)=>$q->where('privacy','public')->orWhere('user_id',$id)->orWhere(fn($q)=>$q->where('privacy','friends')->whereIn('user_id',$friendIds)))->latest()->paginate(10);$friendRequestCount=Friendship::where('receiver_id',$id)->where('status','pending')->count();$suggestions=User::whereKeyNot($id)->whereNotIn('id',$friendIds->push($id))->latest()->limit(5)->get();return view('feed.index',compact('posts','suggestions','friendRequestCount'));}
}
