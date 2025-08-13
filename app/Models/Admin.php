<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'admins';

    /**
     * The guard associated with the model.
     */
    protected $guard = 'admin';

    /**
     * Role constants
     */
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_OPERATOR = 'operator';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'phone',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Admin $admin) {
            // Set default values
            $admin->role = $admin->role ?? self::ROLE_OPERATOR;
            $admin->is_active = $admin->is_active ?? true;
        });
    }

    /**
     * Get available roles
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_OPERATOR => 'Operator',
        ];
    }

    /**
     * Query Scopes
     */

    /**
     * Scope to get only active admins
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get admins by role
     */
    public function scopeByRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to search admins
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    /**
     * Relationships
     */

    /**
     * Get berita created by this admin
     */
    public function createdBerita()
    {
        return $this->hasMany(Berita::class, 'created_by');
    }

    /**
     * Get berita updated by this admin
     */
    public function updatedBerita()
    {
        return $this->hasMany(Berita::class, 'updated_by');
    }

    /**
     * Get agenda created by this admin
     */
    public function createdAgenda()
    {
        return $this->hasMany(Agenda::class, 'created_by');
    }

    /**
     * Get agenda updated by this admin
     */
    public function updatedAgenda()
    {
        return $this->hasMany(Agenda::class, 'updated_by');
    }

    /**
     * Backward compatibility - alias for createdBerita
     */
    public function berita()
    {
        return $this->createdBerita();
    }

    /**
     * Backward compatibility - alias for createdAgenda
     */
    public function agenda()
    {
        return $this->createdAgenda();
    }

    /**
     * Accessors & Mutators
     */

    /**
     * Get role label
     */
    public function getRoleLabelAttribute(): string
    {
        return self::getRoles()[$this->role] ?? ucfirst(str_replace('_', ' ', $this->role));
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            // If it's already a full URL, return as is
            if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
                return $this->avatar;
            }

            // Check if file exists in storage with avatars/ path
            if (Storage::disk('public')->exists('avatars/' . $this->avatar)) {
                return asset('storage/avatars/' . $this->avatar);
            }

            // Check if file exists in storage without path prefix (fallback)
            if (Storage::disk('public')->exists($this->avatar)) {
                return asset('storage/' . $this->avatar);
            }
        }

        // Return default avatar using UI Avatars service
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&size=200&background=3B82F6&color=ffffff&bold=true";
    }

    /**
     * Get initials for avatar
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Get formatted last login
     */
    public function getFormattedLastLoginAttribute(): ?string
    {
        return $this->last_login_at ? $this->last_login_at->format('d M Y H:i') : null;
    }

    /**
     * Get human readable last login
     */
    public function getHumanLastLoginAttribute(): ?string
    {
        return $this->last_login_at ? $this->last_login_at->diffForHumans() : 'Belum pernah login';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return $this->is_active ? 'green' : 'red';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Helper Methods
     */

    /**
     * Check if admin is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /**
     * Check if admin is admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if admin is operator
     */
    public function isOperator(): bool
    {
        return $this->role === self::ROLE_OPERATOR;
    }

    /**
     * Check if admin is active
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Activate admin
     */
    public function activate(): bool
    {
        return $this->update(['is_active' => true]);
    }

    /**
     * Deactivate admin
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(): bool
    {
        return $this->update(['is_active' => !$this->is_active]);
    }

    /**
     * Update last login information
     */
    public function updateLastLogin(?string $ip = null): bool
    {
        return $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $ip ?: request()->ip(),
        ]);
    }

    /**
     * Check if admin has permission based on role
     */
    public function hasPermission(string $permission): bool
    {
        $permissions = [
            self::ROLE_SUPER_ADMIN => [
                'admin.manage', 'berita.manage', 'agenda.manage', 'settings.manage',
                'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
                'agenda.create', 'agenda.edit', 'agenda.delete', 'agenda.publish',
            ],
            self::ROLE_ADMIN => [
                'berita.manage', 'agenda.manage',
                'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
                'agenda.create', 'agenda.edit', 'agenda.delete', 'agenda.publish',
            ],
            self::ROLE_OPERATOR => [
                'berita.create', 'berita.edit',
                'agenda.create', 'agenda.edit',
            ],
        ];

        return in_array($permission, $permissions[$this->role] ?? []);
    }

    /**
     * Get admin statistics
     */
    public function getStatsAttribute(): array
    {
        return [
            'total_berita_created' => $this->createdBerita()->count(),
            'total_agenda_created' => $this->createdAgenda()->count(),
            'total_berita_published' => $this->createdBerita()->where('status', 'published')->count(),
            'total_agenda_active' => $this->createdAgenda()->where('status', 'aktif')->count(),
        ];
    }

    /**
     * Static Methods
     */

    /**
     * Get active admins
     */
    public static function getActive(int $limit = null)
    {
        $query = static::active()->orderBy('name');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        return $query->get();
    }

    /**
     * Get admins by role
     */
    public static function getByRole(string $role, int $limit = null)
    {
        $query = static::byRole($role)->orderBy('name');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        return $query->get();
    }

    /**
     * Search admins
     */
    public static function searchAdmin(string $query, int $limit = 10)
    {
        return static::search($query)
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    /**
     * Get role statistics
     */
    public static function getRoleStats(): array
    {
        return static::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get()
            ->map(function($item) {
                return [
                    'role' => $item->role,
                    'label' => self::getRoles()[$item->role] ?? ucfirst(str_replace('_', ' ', $item->role)),
                    'count' => $item->count,
                ];
            })
            ->toArray();
    }

    /**
     * Get activity statistics
     */
    public static function getActivityStats(): array
    {
        $totalAdmins = static::count();
        $activeAdmins = static::active()->count();
        $inactiveAdmins = $totalAdmins - $activeAdmins;

        return [
            'total' => $totalAdmins,
            'active' => $activeAdmins,
            'inactive' => $inactiveAdmins,
            'recent_logins' => static::whereNotNull('last_login_at')
                ->where('last_login_at', '>=', now()->subDays(7))
                ->count(),
        ];
    }
}