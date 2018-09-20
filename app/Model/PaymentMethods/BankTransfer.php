<?php

namespace App\Model\PaymentMethods;

use App\Model\Orders\Order;
use App\Model\Orders\OrderHistory;
use App\Model\Statuses\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class BankTransfer extends Model
{
    public function isUses()
    {
        if (config('payment_bank_transfer.status') != 1) {
            return false;
        }

        if (config('payment_bank_transfer.total') > Cart::getSubTotal()) {
            return false;
        } else {
            return true;
        }
    }

    public function getListName()
    {
        return config('payment_bank_transfer.name');
    }

    public function getMethodName()
    {
        return 'Banka Havale / Eft';
    }

    public function getKey()
    {
        return 'payment_bank_transfer';
    }

    public function getView()
    {
        return view()->make('frontend.payment_methods.bank_transfer_view');
    }

    public function confirm(Order $order)
    {
        $order_status = OrderStatus::find(config('payment_bank_transfer.status'));
        OrderHistory::create([
            'order_id' => $order->id(),
            'order_status_id' => $order_status->id(),
            'order_status' => $order_status->name,
            'note' => ''
        ]);
        Order::where('order_id', $order->id())->update([
            'order_status_id' => $order_status->id()
        ]);
        return redirect()->to(route('frontend.cart.success.view', ['id' => $order->id()]))->send();
    }
}
