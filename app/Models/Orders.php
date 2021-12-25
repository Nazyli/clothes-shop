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
        'full_address',
        'zip_code',
        'lat',
        'long',
        'is_confirm',
        'total_price',
        'total_qty',
        'payments_id',
        'url_evidence_transfer',
        'no_resi',
        'is_confirm',
        'confirm_by',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrdersDetail::class);
    }
    public function fullAddressLimit($limit)
    {
        return \Illuminate\Support\Str::limit($this->full_address, $limit, $end = '...');
    }

    public function pathImg()
    {
        return isset($this->url_evidence_transfer) ? asset($this->url_evidence_transfer) : asset("evidence_transfer/default.png");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return PaymentMethod::find($this->payments_id);

    }

}
