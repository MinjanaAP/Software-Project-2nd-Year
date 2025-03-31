<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camera_brand_name extends Model
{
    use HasFactory;
    protected $table = 'camera_brand_name';
    protected $fillable = [
        'brandName',
    ];

    public function versions()
    {
        return $this->hasMany(camera_version::class, 'brand_id', 'id');
    }
}
