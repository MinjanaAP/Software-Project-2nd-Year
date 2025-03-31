<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class home_applicance_version extends Model
{
    use HasFactory;
    protected $table = 'home_applicance_version';
    protected $fillable =[
        'version',
        'brandName'
    ];
}
