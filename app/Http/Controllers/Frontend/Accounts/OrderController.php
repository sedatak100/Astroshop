<?php

namespace App\Http\Controllers\Frontend\Accounts;

use App\Model\Orders\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Profilim', 'link' => route('frontend.account.view')],
            ['name' => 'Siparişlerim', 'link' => '']
        ]);

        $blade = [];

        $orders = Order::orderBy('created_at', 'DESC')
            ->with('orderStatus')
            ->where('order_status_id', '>', '0')
            ->where('customer_id', auth()->user()->id())
            ->paginate(15);
        $blade['orders'] = $orders;

        return view('frontend.accounts.order_lists', $blade);
    }

    public function view($id)
    {
        $order = Order::where('order_status_id', '>', '0')
            ->where('customer_id', auth()->user()->id())
            ->with('orderStatus')
            ->findOrFail($id);

        view()->share('breadcrumbs', [
            ['name' => 'Profilim', 'link' => route('frontend.account.view')],
            ['name' => 'Siparişlerim', 'link' => ''],
            ['name' => '#' . $order->id(), 'link' => '']
        ]);

        $blade = [];
        $blade['order'] = $order;

        return view('frontend.accounts.order_view', $blade);
    }
}
