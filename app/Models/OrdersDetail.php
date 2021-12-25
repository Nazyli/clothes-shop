<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'orders_id',
        'goods_id',
        'goods_name',
        'color',
        'additional_color_price',
        'size',
        'additional_size_price',
        'qty',
        'total_price',
    ];

    public function goods()
    {
        return Goods::find($this->goods_id);

    }
}
