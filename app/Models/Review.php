<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'requested_job_id',
        'rating',
        'comment',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'user_id');
    }

    public function requestedJob()
    {
        return $this->belongsTo(RequestedJob::class, 'requested_job_id', 'job_id');
    }
}
