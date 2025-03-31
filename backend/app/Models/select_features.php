<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class select_features extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature',
    ];
}
