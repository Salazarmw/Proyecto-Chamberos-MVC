<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'idChambero',
        'idTags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idChambero', 'user_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'idTags', 'id');
    }

    public function userTags()
    {
        return $this->hasMany(UsersTag::class, 'idChambero', 'idChambero')
            ->with('tag');
    }
}
