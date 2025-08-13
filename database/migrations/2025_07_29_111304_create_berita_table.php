<?php
// database/migrations/2025_01_01_000001_create_berita_table.php

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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('konten');
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable(); // Array of images
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('kategori', ['umum', 'pembangunan', 'kesehatan', 'pendidikan', 'sosial', 'ekonomi', 'lingkungan'])->default('umum');
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['status', 'published_at']);
            $table->index(['kategori', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index('views');
            $table->index('created_by');

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};