<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title','Social')</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<header class="sticky top-0 z-50 bg-white border-b">
 <div class="max-w-7xl mx-auto px-4 h-16 flex items-center gap-4">
  <a href="{{ route('feed') }}" class="text-2xl font-extrabold text-blue-600">Social</a>
  <form action="{{ route('search') }}" class="hidden md:block flex-1 max-w-md">
   <input name="q" placeholder="Search Social" value="{{ request('q') }}" class="w-full rounded-full bg-gray-100 px-5 py-2 outline-none">
  </form>
  <nav class="ml-auto flex items-center gap-2">
   <a href="{{ route('feed') }}" class="btn btn-light">Home</a>
   <a href="{{ route('friends.index') }}" class="btn btn-light">Friends</a>
   <a href="{{ route('profile', auth()->user()) }}" class="btn btn-light">{{ auth()->user()->name }}</a>
   <form method="POST" action="{{ route('logout') }}">@csrf <button class="btn btn-light">Logout</button></form>
  </nav>
 </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-6">@yield('content')</main>
</body>
</html>
