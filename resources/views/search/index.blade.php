@extends('layouts.social')
@section('title','Search')
@section('content')
<div class="max-w-3xl mx-auto"><h1 class="text-2xl font-bold mb-5">Search results for "{{ $q }}"</h1>
<div class="space-y-3">@forelse($users as $user)<a href="{{ route('profile',$user) }}" class="card p-4 flex items-center gap-4 hover:bg-gray-50"><div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center font-bold">{{ strtoupper(substr($user->name,0,1)) }}</div><div><div class="font-bold">{{ $user->name }}</div><div class="text-sm text-gray-500">{{ $user->bio }}</div></div></a>@empty<div class="card p-6 text-gray-500">No users found.</div>@endforelse</div></div>
@endsection
