<?php
use App\Http\Controllers\CommentController; use App\Http\Controllers\FeedController; use App\Http\Controllers\FriendController; use App\Http\Controllers\LikeController; use App\Http\Controllers\NotificationController; use App\Http\Controllers\PostController; use App\Http\Controllers\ProfileController; use App\Http\Controllers\SavedPostController; use App\Http\Controllers\SearchController; use Illuminate\Support\Facades\Route;
Route::get('/',fn()=>redirect()->route('feed'));
Route::middleware(['auth'])->group(function(){
 Route::get('/home',[FeedController::class,'index'])->name('feed');
 Route::get('/dashboard',fn()=>redirect()->route('feed'))->name('dashboard');
 Route::get('/search',[SearchController::class,'index'])->name('search');
 Route::get('/profile/{user}',[ProfileController::class,'show'])->name('profile');
 Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit'); Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update'); Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
 Route::post('/posts',[PostController::class,'store'])->name('posts.store'); Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy'); Route::post('/posts/{post}/like',[LikeController::class,'toggle'])->name('posts.like');
 Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('comments.store'); Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');
 Route::get('/friends',[FriendController::class,'index'])->name('friends.index'); Route::post('/friends/{user}',[FriendController::class,'store'])->name('friends.store'); Route::post('/friends/{friendship}/accept',[FriendController::class,'accept'])->name('friends.accept'); Route::post('/friends/{friendship}/reject',[FriendController::class,'reject'])->name('friends.reject'); Route::delete('/friends/{user}',[FriendController::class,'destroy'])->name('friends.destroy');
 Route::get('/saved',[SavedPostController::class,'index'])->name('saved.index'); Route::post('/posts/{post}/save',[SavedPostController::class,'toggle'])->name('posts.save');
 Route::get('/notifications',[NotificationController::class,'index'])->name('notifications.index'); Route::post('/notifications/{notification}/read',[NotificationController::class,'read'])->name('notifications.read'); Route::post('/notifications/read-all',[NotificationController::class,'readAll'])->name('notifications.read-all');
});
require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function(){
 Route::get('/', [\App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('dashboard');
 Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class,'users'])->name('users');
 Route::post('/users/{user}/toggle', [\App\Http\Controllers\Admin\AdminController::class,'toggleUser'])->name('users.toggle');
 Route::delete('/users/{user}', [\App\Http\Controllers\Admin\AdminController::class,'deleteUser'])->name('users.delete');
 Route::get('/posts', [\App\Http\Controllers\Admin\AdminController::class,'posts'])->name('posts');
 Route::delete('/posts/{post}', [\App\Http\Controllers\Admin\AdminController::class,'deletePost'])->name('posts.delete');
});
