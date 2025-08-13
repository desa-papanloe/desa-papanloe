<?php
// app/Models/Berita.php - FIXED VERSION (NO IMAGE FEATURES)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'berita';

    /**
     * Status constants
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * Category constants - FIXED to match migration
     */
    const KATEGORI_UMUM = 'umum';
    const KATEGORI_PEMBANGUNAN = 'pembangunan';
    const KATEGORI_KESEHATAN = 'kesehatan';
    const KATEGORI_PENDIDIKAN = 'pendidikan';
    const KATEGORI_SOSIAL = 'sosial';
    const KATEGORI_EKONOMI = 'ekonomi';
    const KATEGORI_LINGKUNGAN = 'lingkungan';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'konten',
        'status',
        'kategori',
        'views',
        'is_featured',
        'allow_comments',
        'meta_description',
        'meta_keywords',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'views' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'created_by',
        'updated_by',
    ];

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }

    /**
     * Get all available categories - FIXED to match migration
     */
    public static function getKategoris(): array
    {
        return [
            self::KATEGORI_UMUM => 'Umum',
            self::KATEGORI_PEMBANGUNAN => 'Pembangunan',
            self::KATEGORI_KESEHATAN => 'Kesehatan',
            self::KATEGORI_PENDIDIKAN => 'Pendidikan',
            self::KATEGORI_SOSIAL => 'Sosial',
            self::KATEGORI_EKONOMI => 'Ekonomi',
            self::KATEGORI_LINGKUNGAN => 'Lingkungan',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            // Generate unique slug if not provided
            if (empty($berita->slug)) {
                $berita->slug = static::generateUniqueSlug($berita->judul);
            }
            
            // Set default values
            $berita->status = $berita->status ?? self::STATUS_DRAFT;
            $berita->kategori = $berita->kategori ?? self::KATEGORI_UMUM;
            $berita->views = $berita->views ?? 0;
            $berita->is_featured = $berita->is_featured ?? false;
            $berita->allow_comments = $berita->allow_comments ?? true;
        });

        static::updating(function (Berita $berita) {
            // Update slug if title changed and slug is empty
            if ($berita->isDirty('judul') && empty($berita->slug)) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
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
            
            if ($counter > 1000) {
                $slug = $originalSlug . '-' . time() . '-' . rand(100, 999);
                break;
            }
            
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
     * Get the admin who created this berita
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'created_by')->withDefault([
            'name' => 'Unknown',
            'email' => 'unknown@example.com',
        ]);
    }

    /**
     * Get the admin who last updated this berita
     */
    public function updater()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'updated_by')->withDefault([
            'name' => 'Unknown', 
            'email' => 'unknown@example.com',
        ]);
    }

    /**
     * Query Scopes
     */

    /**
     * Scope to get only published berita
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope to get only draft berita
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    /**
     * Scope to get only archived berita
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    /**
     * Scope to get only featured berita
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to filter by category
     */
    public function scopeByKategori(Builder $query, string $kategori): Builder
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope to search by title or content
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('konten', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to get popular berita (based on views)
     */
    public function scopePopular(Builder $query, int $limit = 10): Builder
    {
        return $query->orderBy('views', 'desc')->limit($limit);
    }

    /**
     * Scope to get latest berita
     */
    public function scopeLatest(Builder $query, int $limit = 10): Builder
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    /**
     * Accessors & Mutators
     */

    /**
     * Get reading time estimate
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->konten));
        return max(1, ceil($wordCount / 200)); // Assuming 200 words per minute
    }

    /**
     * Get excerpt or generate from content
     */
    public function getExcerptAttribute($value): string
    {
        if (!empty($value)) {
            return $value;
        }

        return Str::limit(strip_tags($this->konten), 200);
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedDateAttribute(): ?string
    {
        if (!$this->published_at) {
            return null;
        }

        return $this->published_at->format('d M Y');
    }

    /**
     * Get human readable published date
     */
    public function getPublishedDateForHumansAttribute(): ?string
    {
        if (!$this->published_at) {
            return null;
        }

        return $this->published_at->diffForHumans();
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PUBLISHED => 'bg-green-100 text-green-800',
            self::STATUS_DRAFT => 'bg-yellow-100 text-yellow-800',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get category display name
     */
    public function getKategoriDisplayAttribute(): string
    {
        $kategoris = static::getKategoris();
        return $kategoris[$this->kategori] ?? ucfirst($this->kategori);
    }

    /**
     * Check if berita is published
     */
    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED 
            && $this->published_at 
            && $this->published_at <= now();
    }

    /**
     * Check if berita is draft
     */
    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Check if berita is archived
     */
    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }

    /**
     * Check if berita is featured
     */
    public function isFeatured(): bool
    {
        return $this->is_featured;
    }

    /**
     * Get related berita (same category)
     */
    public function getRelatedBerita(int $limit = 5)
    {
        return static::where('kategori', $this->kategori)
                    ->where('id', '!=', $this->id)
                    ->published()
                    ->latest('published_at')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Increment views counter
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }
}