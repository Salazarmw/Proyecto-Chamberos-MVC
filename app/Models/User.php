<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'province',
        'canton',
        'address',
        'birth_date',
        'user_type',
        'average_rating',
        'rating_count',
        'blocked_for_review',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'average_rating' => 'decimal:2',
            'blocked_for_review' => 'boolean',
            'password' => 'hashed',
        ];
    }

    // Relationship for tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'users_tags', 'idChambero', 'idTags');
    }

    // Filter chambero users
    public function scopeChamberos($query)
    {
        return $query->where('user_type', 'chambero');
    }
}
