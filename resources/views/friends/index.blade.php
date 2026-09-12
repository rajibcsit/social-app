@extends('layouts.social')
@section('title','Friends')
@section('content')
<div class="max-w-4xl mx-auto"><h1 class="text-2xl font-bold mb-5">Friends</h1>
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
@forelse($friends as $friend)<div class="card p-4"><div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold mx-auto">{{ strtoupper(substr($friend->name,0,1)) }}</div><h3 class="text-center font-bold mt-3">{{ $friend->name }}</h3><a href="{{ route('profile',$friend) }}" class="btn btn-primary w-full mt-3">View profile</a></div>
@empty<div class="card p-6 text-gray-500">No accepted friends yet.</div>@endforelse
</div></div>
@endsection
