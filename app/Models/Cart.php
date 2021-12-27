<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'goods_id',
        'goods_color_id',
        'goods_sizes_id',
        'qty',
    ];

    public function goods()
    {
        return Goods::find($this->goods_id);
    }

    public function color()
    {
        return GoodsColor::find($this->goods_color_id);
    }

    public function size()
    {
        return GoodsSize::find($this->goods_sizes_id);
    }

    public function price()
    {
        return ($this->goods()->base_price + $this->color()->additional_price + $this->size()->additional_price) * $this->qty;
    }
}
