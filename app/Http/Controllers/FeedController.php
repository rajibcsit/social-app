<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['user','comments.user'])->withCount('likes')->latest()->paginate(10);
        return view('feed.index', compact('posts'));
    }
}
