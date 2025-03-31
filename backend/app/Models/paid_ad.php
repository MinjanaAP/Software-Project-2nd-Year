<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paid_ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'number',
        'email',
        'url',
        'image',
        'user_id',
       
    ];
}
