<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsColor extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'color',
        'additional_price',
    ];

    public function goodsSizes(){
        return $this->hasMany(GoodsSize::class);
    }

    public function goodsSize(){
        return $this->hasOne(GoodsSize::class);
    }
}
