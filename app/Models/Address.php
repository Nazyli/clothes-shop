<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address_name',
        'is_main',
        'zip_code',
        'full_address',
        'lat',
        'long',
    ];
}
