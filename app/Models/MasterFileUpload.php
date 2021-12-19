<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'url_path'
    ];

    public function pathImg()
    {
        return isset($this->url_path) ? asset($this->url_path) : asset("product/default.png");
    }
}
