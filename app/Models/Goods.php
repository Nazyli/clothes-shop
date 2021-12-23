<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function descriptionLimit()
    {
        return \Illuminate\Support\Str::limit($this->description, 25, $end = '...');
    }

    public function masterFileUploads(){
        return $this->hasMany(MasterFileUpload::class);
    }

    public function masterFileUpload(){
        return $this->hasOne(MasterFileUpload::class);
    }

    public function goodsColors(){
        return $this->hasMany(GoodsColor::class);
    }

    public function goodsColor(){
        return $this->hasOne(GoodsColor::class);
    }

}
