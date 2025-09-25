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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();

            // Required fields
            $table->string('title');                    // Image title
            $table->string('image_url', 2048);          // Absolute or relative URL/path

            // Nice-to-haves (optional; keep or remove)
            $table->string('alt_text')->nullable();     // For accessibility/SEO
            $table->text('caption')->nullable();        // Short description/caption

            $table->timestamps();
            $table->softDeletes();

            $table->index('created_at');                // Speeds up recent listings
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
