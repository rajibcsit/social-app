<?php
namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $id=auth()->id();
        $friends=User::whereIn('id', Friendship::where(function($q)use($id){
            $q->where('sender_id',$id)->orWhere('receiver_id',$id);
        })->where('status','accepted')->get()->map(fn($f)=>$f->sender_id==$id?$f->receiver_id:$f->sender_id))->get();
        return view('friends.index',compact('friends'));
    }

    public function store(Request $request, User $user)
    {
        abort_if($user->id === $request->user()->id,422);
        Friendship::firstOrCreate(
            ['sender_id'=>$request->user()->id,'receiver_id'=>$user->id],
            ['status'=>'pending']
        );
        return back();
    }

    public function destroy(Request $request, User $user)
    {
        Friendship::where(function($q)use($request,$user){
            $q->where('sender_id',$request->user()->id)->where('receiver_id',$user->id);
        })->orWhere(function($q)use($request,$user){
            $q->where('sender_id',$user->id)->where('receiver_id',$request->user()->id);
        })->delete();
        return back();
    }
}
