<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $primaryKey = 'id';

    protected $fillable = [
        'description',
    ];

    public function chamberoProfiles()
    {
        return $this->belongsToMany(ChamberoProfile::class, 'chambero_profile_tag', 'tag_id', 'profile_id');
    }
}
