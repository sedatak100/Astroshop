<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\BackendController;
use App\Model\Orders\Order;
use App\Model\Orders\OrderHistory;
use App\Model\Orders\OrderProduct;
use App\Model\Orders\OrderTotal;
use App\Model\Statuses\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Siparişler', 'link' => '']
        ]);

        $blade = [];

        $orders = Order::orderBy('created_at', 'DESC')
            ->with('orderStatus')
            ->where('order_status_id', '>', '0')
            ->paginate(config('backend.paginate'));
        $blade['orders'] = $orders;

        return view('backend.orders.order_lists', $blade);
    }

    public function view($id)
    {
        $order = Order::findOrFail($id);

        view()->share('breadcrumbs', [
            ['name' => 'Siparişler', 'link' => route('backend.order.lists')],
            ['name' => '#' . $order->id(), 'link' => '']
        ]);

        $blade = [];
        $blade['order'] = $order;

        $order_statuses = OrderStatus::all();
        $blade['order_statuses'] = $order_statuses;

        return view('backend.orders.order_view', $blade);
    }

    public function historyAdd($id, Request $request)
    {
        $request->validate([
            'order_status_id' => 'required|integer',
            'note' => 'nullable',
        ]);

        $order_status = OrderStatus::findOrFail($request->post('order_status_id'));

        OrderHistory::create([
            'order_id' => $id,
            'order_status_id' => $order_status->id(),
            'order_status' => $order_status->name,
            'note' => $request->post('note')
        ]);

        Order::where('order_id', $id)->update([
            'order_status_id' => $order_status->id()
        ]);

        return redirect()->route('backend.order.view', ['id' => $id])
            ->with('success', 'Sipariş Durumu Güncellendi');
    }

    public function remove($id)
    {
        Order::destroy($id);
        OrderHistory::where('order_id', $id)->delete();
        OrderProduct::where('order_id', $id)->delete();
        OrderTotal::where('order_id', $id)->delete();


        return redirect()->route('backend.order.lists')
            ->with('success', 'Sipariş Silindi');
    }
}
