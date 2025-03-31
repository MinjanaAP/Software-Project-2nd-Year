<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camera_features extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'freeAd_id',
        'Display_size',
        'Display_type',
        'Battery_capercity',
        'RAM',
        'Storage',
        'Colour',
        'Year',
        'Used_time_period'
    ];
}
