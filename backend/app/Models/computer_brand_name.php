<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class computer_brand_name extends Model
{
    use HasFactory;
    protected $table = 'computer_brand_name';
    protected $fillable = [
        'brandName',
    ];

    public function versions()
    {
        return $this->hasMany(computer_version::class, 'brand_id', 'id');
    }
}
