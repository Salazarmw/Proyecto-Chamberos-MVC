<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'status',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
