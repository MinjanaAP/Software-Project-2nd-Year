<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sound_brand_name extends Model
{
    use HasFactory;
    protected $table = 'sound_brand_name';
    protected $fillable = [
        'brandName',
    ];
    public function versions()
    {
        return $this->hasMany(sound_version::class, 'brand_id', 'id');
    }
}
