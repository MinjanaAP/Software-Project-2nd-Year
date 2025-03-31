<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobile_versions extends Model
{
    use HasFactory;
    protected $table = 'mobile_versions';
    protected $fillable =[
        'version',
        'brandName'
    ];
    public function brand()
    {
        return $this->belongsTo(brand_names::class, 'brand_id', 'id');
    }
}
