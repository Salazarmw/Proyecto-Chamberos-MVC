<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedJob extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'job_id';

    protected $fillable = [
        'client_id',
        'chambero_id',
        'quote_id',
        'status',
        'is_paid',
        'is_reviewed',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function chambero()
    {
        return $this->belongsTo(User::class, 'chambero_id');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quote_id');
    }
}
