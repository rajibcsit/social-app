<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'body'=>'nullable|string|max:5000',
            'image'=>'nullable|image|max:5120',
            'privacy'=>'required|in:public,friends,only_me',
        ]);

        if (!$request->filled('body') && !$request->hasFile('image')) {
            return back()->withErrors(['body'=>'Write something or choose an image.']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts','public');
        }

        $data['user_id'] = $request->user()->id;
        Post::create($data);
        return back()->with('success','Post published.');
    }

    public function destroy(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);
        $post->delete();
        return back()->with('success','Post deleted.');
    }
}
