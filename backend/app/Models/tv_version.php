<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tv_version extends Model
{
    use HasFactory;
    protected $table = 'tv_version';
    protected $fillable =[
        'version',
        'brandName'
    ];
    public function brand()
    {
        return $this->belongsTo(tv_brand_name::class, 'brand_id', 'id');
    }
}
