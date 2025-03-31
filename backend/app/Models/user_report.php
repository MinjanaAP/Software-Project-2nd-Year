<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'free_ad_id ',
        'user_description',
        'status',
        'assignee',
        'admin_report',
        'title'
    ];
}
