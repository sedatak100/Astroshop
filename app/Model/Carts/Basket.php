<?php

namespace App\Model\Carts;

use App\Model\Coupons\Coupon;
use App\Model\Products\Product;
use App\Model\Taxes\TaxClass;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public static function add($product_id, $quantity, $update = false)
    {
        $errors = [];

        $product = Product::where([
            'status' => 1
        ])->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        })->find($product_id);

        if (!$product) {
            $errors[] = 'Ürün bulunamadı';
        }

        if ($update) {
            if (Cart::get($product_id)) {
                $quantity = Cart::get($product_id)->quantity + $quantity;
            }
        }

        if ($product) {
            if ($product->min_quantity > $quantity) {
                $errors[] = $product->name . ' ürününden minumum ' . $product->min_quantity . ' adet sipariş verebilirsiniz';
            }

            if ($product->quantity < $quantity) {
                $errors[] = $product->name . ' üründen maksimum ' . $product->quantity . ' adet sipariş verebilirsiniz';
            }
        }

        if (count($errors) < 1) {
            $data = [];
            $data['id'] = $product->id();
            $data['name'] = $product->name;
            $data['quantity'] = $quantity;

            if ($product->currentCampaign) {
                $data['price'] = $product->currentCampaign->calcPrice($product->currency_id);
            } else {
                $current_discount = $product->currentDiscounts->where('quantity', '<=', $quantity)
                    ->sortByDesc('quantity')
                    ->first();
                if ($current_discount) {
                    $data['price'] = $current_discount->calcPrice($product->currency_id);
                } else {
                    $data['price'] = $product->calcPrice();
                }
            }
            $data['attributes'] = [
                'model' => $product->model
            ];

            $tax_condition = new CartCondition([
                'name' => 'tax',
                'type' => 'tax',
                'value' => TaxClass::onlyCalc($data['price'], $product->tax_class_id, true)
            ]);
            $data['conditions'] = $tax_condition;

            Cart::remove($product_id);
            Cart::add($data);

            $coupon_code = session('coupon_code');
            if ($coupon_code != '') {
                Coupon::uses($coupon_code);
            }

            $results = [
                'status' => 1,
                'errors' => [],
                'product' => $product,
                'message' => 'Ürün Sepete Eklendi'
            ];
        } else {
            $results = [
                'status' => 0,
                'errors' => $errors,
                'product' => false,
                'message' => 'Hatalar Var'
            ];
        }
        return $results;
    }
}
