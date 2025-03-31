<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteAds extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ad_ids',
    ];

    protected $casts = [
        'ad_ids' => 'array', // Ensure ad_ids is treated as an array
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
