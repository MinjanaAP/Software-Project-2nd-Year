<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class home_security_brand_name extends Model
{
    use HasFactory;
    protected $table = 'home_security_brand_name';
    protected $fillable = [
        'brandName',
    ];
    public function versions()
    {
        return $this->hasMany(home_security_version::class, 'brand_id', 'id');
    }
}
