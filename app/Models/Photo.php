<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        $this->belongsTo(Brand::class);
    }

    public function getPathAttribute($photo)
    {
        return '/images/'.$photo;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
