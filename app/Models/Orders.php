<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'is_membership',
        'email',
        'full_addreas',
        'zip_code',
        'lat',
        'long',
        'is_confirm',
        'total_price',
        'total_qty',
        'payments_id',
        'url_evidence_transfer',
        'no_resi',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrdersDetail::class);
    }
}
