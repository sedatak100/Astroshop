<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Model\Orders\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuccessController extends Controller
{
    public function view($id)
    {
        $blade = [];

        view()->share('breadcrumbs', [
            ['name' => 'Sipariş Onaylandı', 'link' => ''],
        ]);

        $order = Order::find($id);

        if (!session()->has('order') || !$order || session('order')->id() != $order->id()) {
            return redirect()->route('frontend.home.index');
        }

        session()->remove('order');
        session()->remove('coupon_code');
        Cart::clear();

        return view('frontend.carts.success_view', $blade);
    }
}
