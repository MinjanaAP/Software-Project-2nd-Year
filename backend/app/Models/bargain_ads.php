<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class bargain_ads extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'bargain_price',
//         'description',
//         'free_ad_id',
//         'view_count',
//     ];
// }

class bargain_ads extends Model
{
        use HasFactory;
        protected $table = 'bargain_ads';
    protected $fillable = [
        'user_id',
        'bargain_price',
        'description',
        'free_ad_id',
    ];


    // Define the relationship with FreeAd
    public function free_ad()
    {
        return $this->belongsTo(free_ad::class, 'free_ad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
