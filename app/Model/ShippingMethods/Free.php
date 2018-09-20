<?php

namespace App\Model\ShippingMethods;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Model;

class Free extends Model
{
    public function isUses()
    {
        if (config('shipping_free.status') != 1) {
            return false;
        }

        if (config('shipping_free.total') > Cart::getSubTotal()) {
            return false;
        } else {
            return true;
        }
    }

    public function getAmount()
    {
        return 0;
    }

    public function getMethodName()
    {
        return 'Ücretsiz Kargo';
    }

    public function getKey()
    {
        return 'shipping_free';
    }
}
