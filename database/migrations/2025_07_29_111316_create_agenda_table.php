<?php
// database/migrations/2025_07_29_111316_create_agenda_table.php

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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->longText('detail')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('kategori', ['rapat', 'kegiatan', 'sosialisasi', 'gotong_royong', 'pelatihan', 'upacara', 'lainnya'])->default('kegiatan');
            $table->enum('status', ['aktif', 'nonaktif', 'selesai', 'dibatalkan'])->default('aktif');
            $table->enum('prioritas', ['rendah', 'normal', 'tinggi', 'urgent'])->default('normal');
            
            // Waktu dan tempat
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat');
            $table->text('alamat_lengkap')->nullable();
            $table->string('koordinat')->nullable(); // lat,lng untuk maps
            
            // Penyelenggara dan peserta
            $table->string('penyelenggara')->nullable();
            $table->text('target_peserta')->nullable();
            $table->integer('kapasitas_peserta')->nullable();
            $table->integer('jumlah_pendaftar')->default(0);
            $table->boolean('perlu_pendaftaran')->default(false);
            $table->datetime('batas_pendaftaran')->nullable();
            
            // Contact person
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            
            // Additional info
            $table->text('persyaratan')->nullable();
            $table->text('fasilitas')->nullable();
            $table->decimal('biaya', 10, 2)->nullable();
            $table->json('dokumen')->nullable(); // Array of documents
            $table->text('catatan')->nullable();
            
            // SEO
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            // Tracking
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['status', 'tanggal_mulai']);
            $table->index(['kategori', 'status']);
            $table->index(['tanggal_mulai', 'tanggal_selesai']);
            $table->index(['is_featured', 'status']);
            $table->index('prioritas');
            $table->index('created_by');
            $table->index('slug');

            // Foreign key constraints (pastikan tabel admins sudah dibuat sebelumnya)
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};