<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('saved_posts', function(Blueprint $t){ $t->id(); $t->foreignId('user_id')->constrained()->cascadeOnDelete(); $t->foreignId('post_id')->constrained()->cascadeOnDelete(); $t->timestamps(); $t->unique(['user_id','post_id']); }); }
 public function down(): void { Schema::dropIfExists('saved_posts'); }
};
