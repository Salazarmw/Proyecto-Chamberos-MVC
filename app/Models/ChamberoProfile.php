<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamberoProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'user_id',
        'profile_completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'users_tags', 'idChambero', 'idTags');
    }
}
