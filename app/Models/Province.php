<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre'];

    public function cantons()
    {
        return $this->hasMany(Canton::class);
    }
}
