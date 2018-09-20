<?php

namespace App\Model\Coupons;

use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    protected $primaryKey = 'coupon_product_id';

    protected $fillable = [
        'coupon_id', 'product_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
