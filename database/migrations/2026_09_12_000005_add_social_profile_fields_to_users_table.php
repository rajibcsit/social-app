<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::table('users', function(Blueprint $t){
  $t->text('bio')->nullable(); $t->string('avatar')->nullable(); $t->string('cover')->nullable();
  $t->string('location')->nullable(); $t->string('website')->nullable();
  $t->string('phone',30)->nullable(); $t->timestamp('last_seen_at')->nullable();
 }); }
 public function down(): void { Schema::table('users', function(Blueprint $t){ $t->dropColumn(['bio','avatar','cover','location','website','phone','last_seen_at']); }); }
};
