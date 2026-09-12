@extends('layouts.social')
@section('title','Home')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-[250px_minmax(0,680px)_250px] gap-6 justify-center">
 <aside class="hidden lg:block">
  <div class="card p-4 sticky top-24">
   <a class="block font-semibold p-2 hover:bg-gray-100 rounded" href="{{ route('profile',auth()->user()) }}">👤 Profile</a>
   <a class="block font-semibold p-2 hover:bg-gray-100 rounded" href="{{ route('friends.index') }}">👥 Friends</a>
   <a class="block font-semibold p-2 hover:bg-gray-100 rounded">👨‍👩‍👧 Groups</a>
   <a class="block font-semibold p-2 hover:bg-gray-100 rounded">🔔 Notifications</a>
  </div>
 </aside>

 <section class="space-y-4">
  <div class="card p-4">
   <div class="flex gap-3">
    <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
    <button onclick="document.getElementById('post-modal').classList.remove('hidden')" class="flex-1 text-left bg-gray-100 rounded-full px-5 text-gray-500">What's on your mind?</button>
   </div>
  </div>

  @foreach($posts as $post)
  <article class="card overflow-hidden">
   <div class="p-4 flex items-center gap-3">
    <div class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center font-bold">{{ strtoupper(substr($post->user->name,0,1)) }}</div>
    <div><a class="font-bold hover:underline" href="{{ route('profile',$post->user) }}">{{ $post->user->name }}</a>
     <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }} · {{ ucfirst($post->privacy) }}</div>
    </div>
   </div>
   @if($post->body)<div class="px-4 pb-4 whitespace-pre-line text-[15px]">{{ $post->body }}</div>@endif
   @if($post->image)<img src="{{ asset('storage/'.$post->image) }}" class="w-full max-h-[650px] object-cover">@endif
   <div class="px-4 py-3 text-sm text-gray-500 border-b">{{ $post->likes_count }} likes · {{ $post->comments->count() }} comments</div>
   <div class="grid grid-cols-3 border-b">
    <form method="POST" action="{{ route('posts.like',$post) }}">@csrf<button class="w-full py-3 font-semibold hover:bg-gray-100">{{ $post->isLikedBy(auth()->user()) ? '👍 Liked' : '👍 Like' }}</button></form>
    <button onclick="document.getElementById('comment-{{ $post->id }}').focus()" class="font-semibold hover:bg-gray-100">💬 Comment</button>
    <button class="font-semibold hover:bg-gray-100">↗ Share</button>
   </div>
   <div class="p-4 space-y-3">
    @foreach($post->comments->take(5) as $comment)
     <div class="flex gap-2"><div class="w-8 h-8 shrink-0 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold">{{ strtoupper(substr($comment->user->name,0,1)) }}</div><div class="bg-gray-100 rounded-2xl px-3 py-2"><div class="font-semibold text-sm">{{ $comment->user->name }}</div><div>{{ $comment->body }}</div></div></div>
    @endforeach
    <form method="POST" action="{{ route('comments.store',$post) }}" class="flex gap-2">@csrf<input id="comment-{{ $post->id }}" name="body" required placeholder="Write a comment..." class="flex-1 bg-gray-100 rounded-full px-4 py-2 outline-none"><button class="btn btn-primary">Send</button></form>
   </div>
  </article>
  @endforeach
  {{ $posts->links() }}
 </section>

 <aside class="hidden lg:block"><div class="card p-4 sticky top-24"><h3 class="font-bold mb-3">Sponsored</h3><p class="text-sm text-gray-500">Your advertisement can appear here.</p></div></aside>
</div>

<div id="post-modal" class="hidden fixed inset-0 z-[60] bg-black/50 p-4">
 <div class="max-w-lg mx-auto mt-20 bg-white rounded-2xl p-5">
  <div class="flex justify-between items-center mb-4"><h2 class="text-xl font-bold">Create post</h2><button onclick="document.getElementById('post-modal').classList.add('hidden')" class="text-2xl">×</button></div>
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">@csrf
   <textarea name="body" rows="5" placeholder="What's on your mind?" class="w-full border rounded-xl p-3"></textarea>
   <div class="mt-4 flex gap-3 items-center"><input type="file" name="image" accept="image/*" class="text-sm"><select name="privacy" class="border rounded-lg px-3 py-2"><option value="public">Public</option><option value="friends">Friends</option><option value="only_me">Only me</option></select></div>
   <button class="btn btn-primary w-full mt-4">Post</button>
  </form>
 </div>
</div>
@endsection
