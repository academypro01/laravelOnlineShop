<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attributesValue()
    {
        return $this->belongsToMany(AttributeValue::class, 'attributevalue_product','product_id','attributeValue_id');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
