<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'fabric_material', 'code', 'trandmake', 'price_new', 'price_old', 'color', 'desc', 'content', 'category_product', 'qty', 'thumb', 'thumb1', 'thumb2', 'thumb3', 'author', 'status', 'S', 'M', 'L', 'XL', 'XXL', 'slug'];
}
