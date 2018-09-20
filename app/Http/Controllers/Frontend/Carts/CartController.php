<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Http\Controllers\FrontendController;
use App\Model\Carts\Basket;
use App\Model\Products\Product;
use App\Model\Taxes\TaxClass;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class CartController extends FrontendController
{
    public function add(Request $request)
    {
        $errors = [];

        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
        }

        if (count($errors) < 1) {
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity');

            $add = Basket::add($product_id, $quantity, true);
            if ($add['status'] == 1) {
                $response = [
                    'status' => 1,
                    'message' => 'Ürün Sepete Eklendi'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => implode('<br />', $add['errors'])
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'message' => implode('<br />', $errors)
            ];
        }
        return response()->json($response);
    }

    public function updateMultiple(Request $request)
    {
        $errors = [];
        $carts = $request->input('cart');
        foreach ($carts as $i => $cart) {
            $validator = \Validator::make($request->all(), [
                'cart.' . $i . '.product_id' => 'required|integer',
                'cart.' . $i . '.quantity' => 'required|integer',
            ]);

            //todo: burdan devam edilecek.
            if ($validator->errors()->count() < 1) {
                $product_id = $request->input('cart.' . $i . '.product_id');
                $quantity = $request->input('cart.' . $i . '.quantity');

                $add = Basket::add($product_id, $quantity);
                if ($add['status'] != 1) {
                    $errors = array_shift($add['errors']);
                }
            } else {
                $errors['total'] = $validator->errors()->first();
            }
        }

        return redirect()->route('frontend.cart.basket.view')->withErrors($errors);
    }

    public function remove(Request $request)
    {
        $errors = [];

        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
        }
        $product_id = $request->input('product_id');

        if (count($errors) < 1) {
            Cart::remove($product_id);
            $response = [
                'status' => 1,
                'message' => 'Ürün Sepetden Kaldırıldı'
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => implode('<br />', $errors)
            ];
        }
        return response()->json($response);
    }
}
