<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class NotificationController extends Controller {
 public function index(Request $request){$notifications=$request->user()->notifications()->latest()->paginate(20); return view('notifications.index',compact('notifications'));}
 public function read(Request $request,string $notification){$n=$request->user()->notifications()->findOrFail($notification);$n->markAsRead();return back();}
 public function readAll(Request $request){$request->user()->unreadNotifications->markAsRead();return back();}
}
