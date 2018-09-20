<?php

namespace App\Model\Coupons;

use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model
{
    protected $primaryKey = 'coupon_history_id';

    protected $fillable = [
        'coupon_id', 'order_id', 'customer_id', 'amount'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
