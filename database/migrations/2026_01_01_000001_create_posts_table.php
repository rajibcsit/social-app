<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
 public function up(): void { Schema::create('posts',function(Blueprint $t){
  $t->id(); $t->foreignId('user_id')->constrained()->cascadeOnDelete();
  $t->text('body')->nullable(); $t->string('image')->nullable();
  $t->enum('privacy',['public','friends','only_me'])->default('public');
  $t->timestamps(); $t->index(['user_id','created_at']);
 });}
 public function down(): void { Schema::dropIfExists('posts'); }
};
