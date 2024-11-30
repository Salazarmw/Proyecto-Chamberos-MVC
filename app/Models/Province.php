<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre'];

    public function cantones()
    {
        return $this->hasMany(Canton::class);
    }
}
