<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    protected $table = 'product_offer';
    protected $fillable = [
        'offer','is_active'
    ];
}
