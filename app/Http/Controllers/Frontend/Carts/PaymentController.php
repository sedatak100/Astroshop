<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Http\Controllers\FrontendController;
use App\Model\Orders\Order;
use App\Model\PaymentMethods\PaymentMethod;
use Illuminate\Http\Request;

class PaymentController extends FrontendController
{
    public function view($id, Request $request)
    {
        $blade = [];

        $order = Order::findOrFail($id);

        if (!$order || !session()->has('order') || session('order')->id() != $order->id()) {
            return redirect()->route('frontend.home.index');
        }

        $method = PaymentMethod::getUseMethod($order->payment_key);
        if (!$method) {
            return redirect()->route('frontend.home.index');
        }

        view()->share('breadcrumbs', [
            ['name' => 'Sepetim', 'link' => route('frontend.cart.basket.view')],
            ['name' => 'Teslimat ve Fatura Bilgileri', 'link' => route('frontend.cart.shipping.view')],
            ['name' => 'Ödeme', 'link' => ''],
        ]);

        if ($request->post('callback')) {
            $blade['content'] = $method->{$request->post('callback')}($order);
        } else {
            $blade['content'] = $method->getView();
        }
        return view('frontend.carts.payment_view', $blade);
    }
}
