<?php
// app/Models/Agenda.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'agenda';

    /**
     * Status constants
     */
    const STATUS_AKTIF = 'aktif';
    const STATUS_NONAKTIF = 'nonaktif';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DIBATALKAN = 'dibatalkan';

    /**
     * Priority constants
     */
    const PRIORITAS_RENDAH = 'rendah';
    const PRIORITAS_NORMAL = 'normal';
    const PRIORITAS_TINGGI = 'tinggi';
    const PRIORITAS_URGENT = 'urgent';

    /**
     * Category constants
     */
    const KATEGORI_RAPAT = 'rapat';
    const KATEGORI_KEGIATAN = 'kegiatan';
    const KATEGORI_SOSIALISASI = 'sosialisasi';
    const KATEGORI_GOTONG_ROYONG = 'gotong_royong';
    const KATEGORI_PELATIHAN = 'pelatihan';
    const KATEGORI_UPACARA = 'upacara';
    const KATEGORI_LAINNYA = 'lainnya';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'detail',
        'featured_image',
        'kategori',
        'status',
        'prioritas',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'alamat_lengkap',
        'koordinat',
        'penyelenggara',
        'target_peserta',
        'kapasitas_peserta',
        'jumlah_pendaftar',
        'perlu_pendaftaran',
        'batas_pendaftaran',
        'contact_person',
        'contact_phone',
        'contact_email',
        'persyaratan',
        'fasilitas',
        'biaya',
        'dokumen',
        'catatan',
        'meta_description',
        'meta_keywords',
        'views',
        'is_featured',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'datetime',
            'tanggal_selesai' => 'datetime',
            'batas_pendaftaran' => 'datetime',
            'perlu_pendaftaran' => 'boolean',
            'is_featured' => 'boolean',
            'dokumen' => 'array',
            'biaya' => 'decimal:2',
            'kapasitas_peserta' => 'integer',
            'jumlah_pendaftar' => 'integer',
            'views' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Agenda $agenda) {
            // Generate slug if not provided
            if (empty($agenda->slug)) {
                $agenda->slug = static::generateUniqueSlug($agenda->judul);
            }
            
            // Set defaults
            $agenda->kategori = $agenda->kategori ?? self::KATEGORI_LAINNYA;
            $agenda->status = $agenda->status ?? self::STATUS_AKTIF;
            $agenda->prioritas = $agenda->prioritas ?? self::PRIORITAS_NORMAL;
            $agenda->views = $agenda->views ?? 0;
            $agenda->jumlah_pendaftar = $agenda->jumlah_pendaftar ?? 0;
            $agenda->perlu_pendaftaran = $agenda->perlu_pendaftaran ?? false;
            $agenda->is_featured = $agenda->is_featured ?? false;
        });

        static::updating(function (Agenda $agenda) {
            // Update slug if title changed and slug is empty
            if ($agenda->isDirty('judul') && empty($agenda->slug)) {
                $agenda->slug = static::generateUniqueSlug($agenda->judul, $agenda->id);
            }
        });
    }

    /**
     * Get route key name for model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Generate unique slug
     */
    protected static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Relationships
     */

    /**
     * Get the admin who created this agenda
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'created_by')->withDefault([
            'name' => 'Unknown',
            'email' => 'unknown@example.com',
        ]);
    }

    /**
     * Get the admin who last updated this agenda
     */
    public function updater()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'updated_by')->withDefault([
            'name' => 'Unknown',
            'email' => 'unknown@example.com',
        ]);
    }

    /**
     * Backward compatibility - alias for creator
     */
    public function admin()
    {
        return $this->creator();
    }

    /**
     * Query Scopes
     */

    /**
     * Scope to get only active agenda
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_AKTIF);
    }

    /**
     * Scope to get upcoming agenda
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('tanggal_mulai', '>=', now());
    }

    /**
     * Scope to get featured agenda
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get agenda by category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('kategori', $category);
    }

    /**
     * Scope to get agenda by priority
     */
    public function scopeByPriority(Builder $query, string $priority): Builder
    {
        return $query->where('prioritas', $priority);
    }

    /**
     * Scope to get urgent agenda
     */
    public function scopeUrgent(Builder $query): Builder
    {
        return $query->where('prioritas', self::PRIORITAS_URGENT);
    }

    /**
     * Scope to search agenda
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%")
              ->orWhere('tempat', 'like', "%{$search}%")
              ->orWhere('penyelenggara', 'like', "%{$search}%");
        });
    }

    /**
     * Accessors
     */

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute(): string
    {
        if (!$this->tanggal_mulai) {
            return '-';
        }

        $format = 'd M Y';
        if ($this->tanggal_selesai && $this->tanggal_mulai->format('Y-m-d') !== $this->tanggal_selesai->format('Y-m-d')) {
            return $this->tanggal_mulai->format($format) . ' - ' . $this->tanggal_selesai->format($format);
        }

        return $this->tanggal_mulai->format($format);
    }

    /**
     * Get formatted time
     */
    public function getFormattedTimeAttribute(): string
    {
        if (!$this->waktu_mulai) {
            return '-';
        }

        if ($this->waktu_selesai) {
            return $this->waktu_mulai . ' - ' . $this->waktu_selesai;
        }

        return $this->waktu_mulai;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_NONAKTIF => 'Non Aktif',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
            default => 'Unknown'
        };
    }

    /**
     * Get priority label
     */
    public function getPriorityLabelAttribute(): string
    {
        return match($this->prioritas) {
            self::PRIORITAS_RENDAH => 'Rendah',
            self::PRIORITAS_NORMAL => 'Normal',
            self::PRIORITAS_TINGGI => 'Tinggi',
            self::PRIORITAS_URGENT => 'Urgent',
            default => 'Normal'
        };
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->kategori) {
            self::KATEGORI_RAPAT => 'Rapat',
            self::KATEGORI_KEGIATAN => 'Kegiatan',
            self::KATEGORI_SOSIALISASI => 'Sosialisasi',
            self::KATEGORI_GOTONG_ROYONG => 'Gotong Royong',
            self::KATEGORI_PELATIHAN => 'Pelatihan',
            self::KATEGORI_UPACARA => 'Upacara',
            self::KATEGORI_LAINNYA => 'Lainnya',
            default => 'Lainnya'
        };
    }

    /**
     * Get featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        return Storage::url('agenda/' . $this->featured_image);
    }

    /**
     * Check if agenda is upcoming
     */
    public function getIsUpcomingAttribute(): bool
    {
        return $this->tanggal_mulai && $this->tanggal_mulai->isFuture();
    }

    /**
     * Check if agenda is ongoing
     */
    public function getIsOngoingAttribute(): bool
    {
        if (!$this->tanggal_mulai) {
            return false;
        }

        $now = now();
        $start = $this->tanggal_mulai;
        $end = $this->tanggal_selesai ?? $start;

        return $now->between($start, $end);
    }

    /**
     * Check if agenda has passed
     */
    public function getHasPassedAttribute(): bool
    {
        if (!$this->tanggal_mulai) {
            return false;
        }

        $end = $this->tanggal_selesai ?? $this->tanggal_mulai;
        return $end->isPast();
    }

    /**
     * Static methods for getting options
     */

    /**
     * Get all available categories
     */
    public static function getKategoris(): array
    {
        return [
            self::KATEGORI_RAPAT => 'Rapat',
            self::KATEGORI_KEGIATAN => 'Kegiatan',
            self::KATEGORI_SOSIALISASI => 'Sosialisasi',
            self::KATEGORI_GOTONG_ROYONG => 'Gotong Royong',
            self::KATEGORI_PELATIHAN => 'Pelatihan',
            self::KATEGORI_UPACARA => 'Upacara',
            self::KATEGORI_LAINNYA => 'Lainnya',
        ];
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_NONAKTIF => 'Non Aktif',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
        ];
    }

    /**
     * Get all available priorities
     */
    public static function getPrioritas(): array
    {
        return [
            self::PRIORITAS_RENDAH => 'Rendah',
            self::PRIORITAS_NORMAL => 'Normal',
            self::PRIORITAS_TINGGI => 'Tinggi',
            self::PRIORITAS_URGENT => 'Urgent',
        ];
    }
}