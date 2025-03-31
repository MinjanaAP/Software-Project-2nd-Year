<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class computer_version extends Model
{
    use HasFactory;
    protected $table = 'computer_version';
    protected $fillable =[
        'version',
        'brandName'
    ];

}
