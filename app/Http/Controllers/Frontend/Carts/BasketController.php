<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Model\Carts\Basket;
use App\Model\Carts\DBStorage;
use App\Model\Products\Product;
use App\Model\ShippingMethods\ShippingMethod;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
    public function view()
    {
        $blade = [];

        view()->share('breadcrumbs', [
            ['name' => 'Sepetim', 'link' => ''],
        ]);

        ShippingMethod::currentShipping();

        $cart_items = Cart::getContent();
        $cart_items->each(function ($cart_item) {
            $product = Product::with(['brand', 'categories'])->find($cart_item->id);
            $cart_item->put('product', $product);
        });

        $blade['cart_items'] = $cart_items;

        return view('frontend.carts.basket_view', $blade);
    }

    public function logged()
    {
        if (auth()->check()) {
            return redirect()->route('frontend.cart.shipping.view');
        }

        view()->share('breadcrumbs', [
            ['name' => 'Sipariş Öncesi Üyelik', 'link' => ''],
        ]);

        return view('frontend.carts.basket_logged');
    }
}
