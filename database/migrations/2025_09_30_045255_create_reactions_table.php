<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->enum('reaction', ['like','dislike']);
            $table->string('fingerprint', 100); // hash of ip + ua + session id
            $table->string('ip', 45)->nullable();
            $table->string('ua_hash', 64)->nullable();
            $table->string('session_id', 120)->nullable();
            $table->timestamps();

            $table->unique(['blog_id', 'fingerprint']);
            $table->index(['blog_id', 'reaction']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
