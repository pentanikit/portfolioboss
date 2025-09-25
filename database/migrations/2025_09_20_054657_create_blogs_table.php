<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();                 // for SEO-friendly URLs
            $table->string('excerpt', 500)->nullable();       // short summary
            $table->longText('body');                         // main content (HTML/Markdown)

            // Image stored as a string (path or full URL)
            $table->string('image', 2048)->nullable();        // e.g. "uploads/blogs/cover.jpg" or "https://.../cover.jpg"

            // Metadata
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();

            // Optional SEO fields
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 500)->nullable();

            // Housekeeping
            $table->timestamps();
            $table->softDeletes();

            // Helpful indexes
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
