<?php

namespace App\Model\PaymentMethods;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public static function getAll()
    {
        $_methods = [];
        $payment_methods = config('payment.methods') ?? [];
        foreach ($payment_methods as $payment_method) {
            $get_config = 'payment_' . $payment_method;
            $_methods['payment_' . $payment_method] = config($get_config);
        }
        return $_methods;
    }

    public static function useAll()
    {
        $get_all = self::getAll();

        $methods = collect($get_all)->sortBy('order');

        $actives = $methods->map(function ($method, $key) {
            $model = config($key . '.model');
            if (class_exists($model)) {
                $payment = new $model();
                if (method_exists($payment, 'isUses') && $payment->isUses()) {
                    return $payment;
                }
            }
        });
        return $actives;
    }

    public static function getUseMethod($key)
    {
        $methods = self::useAll();
        return $methods->get($key);
    }
}
