<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laptop_version extends Model
{
    use HasFactory;
    protected $table = 'laptop_version';
    protected $fillable =[
        'version',
        'brandName'
    ];
}
