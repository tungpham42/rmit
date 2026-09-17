<?php

namespace App\Models;

use App\Enums\RoleName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role_id',
        'user_alias',
        'name',
        'email',
        'password',
        'user_hash',
        'user_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'user_hash',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_status' => 'boolean',
        ];
    }

    // --- relations ---
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // --- role checks ---
    public function hasRole(RoleName|string $role): bool
    {
        $roleName = $role instanceof RoleName ? $role->value : $role;

        return $this->role?->role_name === $roleName;
    }

    /**
     * @param  array<RoleName|string>  $roles
     */
    public function hasAnyRole(array $roles): bool
    {
        $names = array_map(
            fn ($r) => $r instanceof RoleName ? $r->value : $r,
            $roles
        );

        return in_array($this->role?->role_name, $names, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::Admin);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'user_id', 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'user_courses', 'user_id', 'course_id');
    }

    public function followedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_follows', 'user_id', 'post_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_follows', 'user_id', 'followee_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_follows', 'followee_id', 'user_id');
    }
}
