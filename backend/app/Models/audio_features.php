<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audio_features extends Model
{
    use HasFactory;
    protected $fillable = [
        'Brand',
        'Wireless_or_not',
        'Battery_capercity',
        'Colour',
        'Year',
        'Used_time_period'
    ];
}
