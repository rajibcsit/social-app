<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class AdminController extends Controller {
 public function dashboard(): View { return view('admin.dashboard', ['stats'=>['users'=>User::count(),'active_users'=>User::where('is_active',true)->count(),'posts'=>Post::count(),'comments'=>Comment::count(),'friendships'=>Friendship::where('status','accepted')->count()], 'users'=>User::latest()->limit(8)->get(), 'posts'=>Post::with('user')->latest()->limit(8)->get()]); }
 public function users(): View { return view('admin.users', ['users'=>User::latest()->paginate(20)]); }
 public function toggleUser(User $user): RedirectResponse { if ($user->id === auth()->id()) return back()->with('error','You cannot disable your own account.'); $user->update(['is_active'=>!$user->is_active]); return back()->with('success', 'User status updated.'); }
 public function deleteUser(User $user): RedirectResponse { if ($user->id === auth()->id()) return back()->with('error','You cannot delete your own account.'); $user->delete(); return back()->with('success','User deleted.'); }
 public function posts(): View { return view('admin.posts', ['posts'=>Post::with('user')->latest()->paginate(20)]); }
 public function deletePost(Post $post): RedirectResponse { $post->delete(); return back()->with('success','Post deleted.'); }
}
