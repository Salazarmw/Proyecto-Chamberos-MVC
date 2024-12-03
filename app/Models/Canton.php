<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
