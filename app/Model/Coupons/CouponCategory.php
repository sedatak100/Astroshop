<?php

namespace App\Model\Coupons;

use Illuminate\Database\Eloquent\Model;

class CouponCategory extends Model
{
    protected $primaryKey = 'coupon_category_id';

    protected $fillable = [
        'coupon_id', 'category_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
