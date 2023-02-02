<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['fullname','email','address','phone','note','name_product','code_product','thumb','qty','price','total_price', 'order_code', 'sub_total_price', 'total_qty', 'payment', 'status_order', 'color_product', 'size'];
}
