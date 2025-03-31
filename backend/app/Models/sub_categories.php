<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_categories extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = [
        'Name', 'image_url', 'feature_table', 'brand_table', 'version_table'
    ];
}
