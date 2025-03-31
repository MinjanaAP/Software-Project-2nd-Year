<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camera_version extends Model
{
    use HasFactory;
    protected $table = 'camera_version';
    protected $fillable =[
        'version',
        'brandName'
    ];
}
