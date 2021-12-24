<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_name',
        'description',
        'category_id',
        'is_active',
        'base_price',
        'total_qty'
    ];

    const IS_ACTIVE_YES = 1;
    const IS_ACTIVE_NO = 0;

    public function category()
    {
        return $this->belongsTo(MasterCategory::class);
    }

    public function status()
    {
        return $this->is_active ? 'Active' : 'Non-Active';
    }

    public function descriptionLimit($limit)
    {
        return \Illuminate\Support\Str::limit($this->description, $limit, $end = '...');
    }

    public function masterFileUploads()
    {
        return $this->hasMany(MasterFileUpload::class);
    }

    public function masterFileUpload()
    {
        return MasterFileUpload::where('goods_id', $this->id)->orderBy('created_at', 'desc')->first();
    }

    public function goodsColors()
    {
        return $this->hasMany(GoodsColor::class);
    }

    public function goodsColor()
    {
        return $this->hasOne(GoodsColor::class);
    }

    public function maxPrice()
    {
        return DB::table('goods')
        ->join('goods_colors', 'goods.id', '=', 'goods_colors.goods_id')
        ->join('goods_sizes', 'goods_colors.id', '=', 'goods_sizes.goods_color_id')
        ->select(DB::raw('MAX(goods.base_price) + MAX(goods_colors.additional_price) + MAX(goods_sizes.additional_price) as max_price'))
        ->where('goods.id', '=', $this->id)
        ->groupBy('goods.id')->first()->max_price;
    }

    public function minPrice()
    {
        return DB::table('goods')
        ->join('goods_colors', 'goods.id', '=', 'goods_colors.goods_id')
        ->join('goods_sizes', 'goods_colors.id', '=', 'goods_sizes.goods_color_id')
        ->select(DB::raw('MIN(goods.base_price) + MIN(goods_colors.additional_price) + MIN(goods_sizes.additional_price) as min_price'))
        ->where('goods.id', '=', $this->id)
        ->groupBy('goods.id')->first()->min_price;
    }

    public function getReadySize(){
        return GoodsSize::select('size')->join('goods_colors', 'goods_colors.id', '=', 'goods_sizes.goods_color_id')
            ->where('goods_colors.goods_id', '=', $this->id)
            ->distinct()
            ->get();
    }
}
