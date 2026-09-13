<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(User $user): View
    {
        $friendships = Friendship::where('status', 'accepted')
            ->where(fn ($q) => $q->where('sender_id', $user->id)->orWhere('receiver_id', $user->id))
            ->latest();

        $friendIds = $friendships->get()->map(fn ($f) => $f->sender_id == $user->id ? $f->receiver_id : $f->sender_id);
        $friends = User::whereIn('id', $friendIds)->orderBy('name')->get();
        $friendCount = $friends->count();

        $posts = $user->posts()->with(['user', 'comments.user'])->withCount('likes')->latest()->paginate(10);
        $photos = $user->posts()->whereNotNull('image')->latest()->get();

        return view('profile.show', compact('user', 'posts', 'friends', 'friendCount', 'photos'));
    }

    public function edit(Request $r): View
    {
        return view('profile.edit', ['user' => $r->user()]);
    }

    public function update(ProfileUpdateRequest $r): RedirectResponse
    {
        $user = $r->user();
        $data = $r->validated();
        foreach (['avatar', 'cover'] as $field) {
            if ($r->hasFile($field)) {
                $data[$field] = $r->file($field)->store($field . 's', 'public');
            }
        }
        $user->fill($data);
        if ($user->isDirty('email')) $user->email_verified_at = null;
        $user->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $r): RedirectResponse
    {
        $r->validateWithBag('userDeletion', ['password' => ['required', 'current_password']]);
        $user = $r->user();
        Auth::logout();
        $user->delete();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return Redirect::to('/');
    }
}
