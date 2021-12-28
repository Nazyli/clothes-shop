<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoodsSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_color_id',
        'size',
        'additional_price',
        'qty',
    ];

    public function goodsColor()
    {
        return $this->belongsTo(GoodsColor::class);
    }

    public static function totalQty($id)
    {
        return DB::table('goods_sizes')
            ->join('goods_colors', 'goods_sizes.goods_color_id', '=', 'goods_colors.id')
            ->where('goods_colors.goods_id', '=', $id)
            ->sum('goods_sizes.qty');
    }
}
