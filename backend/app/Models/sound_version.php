<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sound_version extends Model
{
    use HasFactory;
    protected $table = 'sound_version';
    protected $fillable =[
        'version',
        'brandName'
    ];

}
