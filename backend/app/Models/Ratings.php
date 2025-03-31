<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ad_id',
        'stars',
    ];

    public function free_ad()
    {
        return $this->belongsTo(free_ad::class, 'ad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
