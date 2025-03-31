<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laptop_brand_name extends Model
{
    use HasFactory;
    protected $table = 'laptop_brand_name';
    protected $fillable = [
        'brandName',
    ];

    public function versions()
    {
        return $this->hasMany(laptop_version::class, 'brand_id', 'id');
    }
}
