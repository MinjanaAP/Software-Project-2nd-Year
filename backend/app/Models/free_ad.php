<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class free_ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // 'price',
        // 'image_1',
        // 'image_2',
        // 'image_3',
        // 'image_4',
        // 'image_5',
        // 'sub_category',
        // 'category',
        'description',
        'view_count',
    ];

    protected $guarded = ['price'];

    
    // Define the inverse relationship with BargainAd
    public function bargain_ads()
    {
        return $this->hasMany(bargain_ads::class);
    }

    // public function bargainAds() {
    //     return $this->hasMany(bargain_ads::class, 'free_ad_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favouriteAds(){
        return $this->belongsTo(FavouriteAdsLoad::class,'ad_id');
    }
}

