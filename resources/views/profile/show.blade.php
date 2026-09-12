@extends('layouts.social')
@section('title',$user->name)
@section('content')
<div class="max-w-4xl mx-auto">
 <div class="card overflow-hidden">
  <div class="h-48 md:h-72 bg-gradient-to-r from-blue-500 to-indigo-600 relative">
   @if($user->cover)<img src="{{ asset('storage/'.$user->cover) }}" class="w-full h-full object-cover">@endif
  </div>
  <div class="px-5 pb-5">
   <div class="flex flex-col md:flex-row md:items-end gap-4 -mt-14 relative">
    <div class="w-28 h-28 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-600 overflow-hidden">
     @if($user->avatar)<img src="{{ asset('storage/'.$user->avatar) }}" class="w-full h-full object-cover">@else{{ strtoupper(substr($user->name,0,1)) }}@endif
    </div>
    <div class="flex-1"><h1 class="text-2xl font-extrabold">{{ $user->name }}</h1><p class="text-gray-500">{{ $user->bio }}</p></div>
    @if(auth()->id() !== $user->id)<form method="POST" action="{{ route('friends.store',$user) }}">@csrf<button class="btn btn-primary">Add Friend</button></form>@endif
   </div>
  </div>
 </div>
 @if(auth()->id()===$user->id)
 <div class="card p-5 mt-4">
  <h2 class="font-bold mb-3">Edit profile</h2>
  <form method="POST" action="{{ route('profile.update',$user) }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-3">@csrf
   <input name="name" value="{{ $user->name }}" class="border rounded-lg p-2">
   <input name="bio" value="{{ $user->bio }}" placeholder="Bio" class="border rounded-lg p-2">
   <input type="file" name="avatar" accept="image/*"><input type="file" name="cover" accept="image/*">
   <button class="btn btn-primary md:col-span-2">Save profile</button>
  </form>
 </div>
 @endif
 <div class="mt-5 space-y-4">
  @foreach($posts as $post)
   <article class="card p-4"><div class="font-bold">{{ $post->user->name }}</div><div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div><p class="my-3 whitespace-pre-line">{{ $post->body }}</p>@if($post->image)<img src="{{ asset('storage/'.$post->image) }}" class="rounded-xl max-h-[600px] object-cover w-full">@endif</article>
  @endforeach
  {{ $posts->links() }}
 </div>
</div>
@endsection
