<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'chambero_id',
        'service_description',
        'scheduled_date',
        'price',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function chambero()
    {
        return $this->belongsTo(User::class, 'chambero_id');
    }
}
