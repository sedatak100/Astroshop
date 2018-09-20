<?php

namespace App\Model\ShippingMethods;

use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    public static function currentShipping()
    {
        Cart::removeConditionsByType('shipping');

        $_methods = [];
        $shipping_methods = config('shipping.methods') ?? [];
        foreach ($shipping_methods as $shipping_method) {
            $get_config = 'shipping_' . $shipping_method;
            $_methods['shipping_' . $shipping_method] = config($get_config);
        }

        $methods = collect($_methods)->sortBy('order');

        $methods->each(function ($method, $key) {
            $model = config($key . '.model');
            if (class_exists($model)) {
                $shipping = new $model();

                if (method_exists($shipping, 'isUses') && $shipping->isUses()) {
                    $condition = new CartCondition([
                        'name' => 'Kargo Ücreti',
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => '+' . $shipping->getAmount(),
                        'order' => 2,
                        'attributes' => [
                            'class' => $shipping
                        ]
                    ]);
                    Cart::condition($condition);
                    return false;
                }
            }
        });
    }
}
