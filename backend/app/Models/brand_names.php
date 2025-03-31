<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand_names extends Model
{
    use HasFactory;
    protected $table = 'brand_names';
    protected $fillable = [
        'brandName',
    ];
    public function versions()
    {
        return $this->hasMany(mobile_versions::class, 'brand_id', 'id');
    }
    
   
}
