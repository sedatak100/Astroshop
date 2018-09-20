<?php

namespace App\Model\ShippingMethods;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Model;

class Fixed extends Model
{
    public function isUses()
    {
        if (config('shipping_fixed.status') != 1) {
            return false;
        }

        if (config('shipping_fixed.total') > Cart::getSubTotal()) {
            return false;
        } else {
            return true;
        }
    }

    public function getAmount()
    {
        return config('shipping_fixed.amount');
    }

    public function getMethodName()
    {
        return 'Sabit Fiyatlı Kargo';
    }

    public function getKey()
    {
        return 'shipping_fixed';
    }
}
