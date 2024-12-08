<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersTag extends Model
{
    use HasFactory;

    protected $table = 'users_tags';

    protected $fillable = [
        'idChambero',
        'idTags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idChambero');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'idTags');
    }

    public function userTags()
    {
        return $this->hasMany(UsersTag::class, 'idChambero')
            ->with('tag');
    }
}
