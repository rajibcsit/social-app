@extends('layouts.social')
@section('title',$user->name.' · Connectly')
@section('content')
<div class="max-w-5xl mx-auto">
 <div class="card overflow-hidden">
  <div class="h-52 md:h-80 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-700 relative">
   @if($user->cover)<img src="{{ asset('storage/'.$user->cover) }}" class="w-full h-full object-cover">@endif
   <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
  </div>
  <div class="px-5 pb-5">
   <div class="flex flex-col md:flex-row md:items-end gap-4 -mt-14 relative">
    <div class="w-28 h-28 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-600 overflow-hidden shadow-lg">
     @if($user->avatar)<img src="{{ asset('storage/'.$user->avatar) }}" class="w-full h-full object-cover">@else{{ strtoupper(substr($user->name,0,1)) }}@endif
    </div>
    <div class="flex-1"><h1 class="text-2xl font-extrabold">{{ $user->name }}</h1><p class="text-gray-500">{{ $user->bio ?: 'Connect with me on Connectly.' }}</p><div class="text-xs text-slate-500 mt-2 space-x-3">@if($user->location)<span>📍 {{ $user->location }}</span>@endif @if($user->website)<a class="text-blue-600" href="{{ $user->website }}" target="_blank" rel="noopener">🔗 Website</a>@endif</div></div>
    @if(auth()->id() === $user->id)<a href="{{ route('profile.edit') }}" class="btn btn-light">Edit Profile</a>@else<form method="POST" action="{{ route('friends.store',$user) }}">@csrf<button class="btn btn-primary">Add Friend</button></form>@endif
   </div>
   <div class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-6 pt-5 border-t"><div class="text-center"><div class="font-black text-xl">{{ $posts->total() }}</div><div class="text-xs text-slate-500">Posts</div></div><div class="text-center"><div class="font-black text-xl">{{ $friendCount }}</div><div class="text-xs text-slate-500">Friends</div></div><div class="text-center"><div class="font-black text-xl">{{ $photos->count() }}</div><div class="text-xs text-slate-500">Photos</div></div><div class="text-center hidden sm:block"><div class="font-black text-xl">{{ $user->created_at->format('Y') }}</div><div class="text-xs text-slate-500">Joined</div></div></div>
  </div>
 </div>

 <div class="grid lg:grid-cols-[minmax(0,1fr)_300px] gap-5 mt-5">
  <div class="space-y-4">
   <div class="card p-5"><h2 class="font-black text-lg mb-4">Posts</h2>
   @forelse($posts as $post)<article class="border-b last:border-0 pb-5 mb-5 last:mb-0 last:pb-0"><div class="flex items-center gap-3"><div class="avatar-sm">{{ strtoupper(substr($user->name,0,1)) }}</div><div><div class="font-bold">{{ $user->name }}</div><div class="text-xs text-slate-500">{{ $post->created_at->diffForHumans() }}</div></div></div>@if($post->body)<p class="my-3 whitespace-pre-line leading-7">{{ $post->body }}</p>@endif @if($post->image)<img src="{{ asset('storage/'.$post->image) }}" class="rounded-2xl max-h-[600px] object-cover w-full">@endif</article>@empty<div class="text-center py-10 text-slate-500">No posts yet.</div>@endforelse
   {{ $posts->links() }}</div>
  </div>
  <aside class="space-y-5">
   <div class="card p-5"><div class="flex items-center justify-between mb-4"><h2 class="font-black">Friends</h2><span class="text-sm font-bold text-blue-600">{{ $friendCount }}</span></div><div class="space-y-3">@forelse($friends as $friend)<a href="{{ route('profile',$friend) }}" class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50"><div class="avatar-sm">{{ strtoupper(substr($friend->name,0,1)) }}</div><div class="min-w-0"><div class="font-semibold truncate">{{ $friend->name }}</div><div class="text-xs text-emerald-600">● Connected</div></div></a>@empty<div class="text-sm text-slate-500">No friends yet.</div>@endforelse</div></div>
   <div class="card p-5"><h2 class="font-black mb-4">Photos</h2>@if($photos->count())<div class="grid grid-cols-3 gap-2">@foreach($photos as $photo)<a href="{{ asset('storage/'.$photo->image) }}" target="_blank"><img src="{{ asset('storage/'.$photo->image) }}" class="aspect-square w-full object-cover rounded-xl hover:opacity-80 transition" alt="Photo"></a>@endforeach</div>@else<div class="text-sm text-slate-500">No photos yet.</div>@endif</div>
  </aside>
 </div>
</div>
@endsection
