<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteAdsLoad extends Model
{
    use HasFactory;
    protected $fillable = [
        'ad_id',
        'user_ids',
    ];

    protected $casts = [
        'user_ids' => 'array', // Ensure ad_ids is treated as an array
    ];

     // Define the relationship with FreeAd
    public function free_ad()
    {
        return $this->belongsTo(free_ad::class, 'ad_id');
    }

    public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

}
