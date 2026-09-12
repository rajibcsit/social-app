<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('friendships',function(Blueprint $t){
  $t->id(); $t->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
  $t->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
  $t->enum('status',['pending','accepted','rejected'])->default('pending'); $t->timestamps();
  $t->unique(['sender_id','receiver_id']);
 });}
 public function down(): void { Schema::dropIfExists('friendships'); }
};
