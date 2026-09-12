<?php
namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest; use App\Models\User; use Illuminate\Http\RedirectResponse; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth; use Illuminate\Support\Facades\Redirect; use Illuminate\View\View;
class ProfileController extends Controller {
 public function show(User $user): View { $posts=$user->posts()->with('user')->latest()->paginate(10); return view('profile.show',compact('user','posts')); }
 public function edit(Request $r): View{return view('profile.edit',['user'=>$r->user()]);}
 public function update(ProfileUpdateRequest $r): RedirectResponse {$user=$r->user();$data=$r->validated();foreach(['avatar','cover'] as $field){if($r->hasFile($field))$data[$field]=$r->file($field)->store($field.'s','public');} $user->fill($data);if($user->isDirty('email'))$user->email_verified_at=null;$user->save();return Redirect::route('profile.edit')->with('status','profile-updated');}
 public function destroy(Request $r): RedirectResponse {$r->validateWithBag('userDeletion',['password'=>['required','current_password']]);$user=$r->user();Auth::logout();$user->delete();$r->session()->invalidate();$r->session()->regenerateToken();return Redirect::to('/');}
}
