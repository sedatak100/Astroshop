<?php

namespace App\Listeners;

use App\Events\OrderHistoryCreated;
use App\Model\Coupons\Coupon;
use App\Model\Orders\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CouponHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderHistoryCreated $event
     * @return void
     */
    public function handle(OrderHistoryCreated $event)
    {
        $status_completed = config('config.status_completed') ?? [];
        if (in_array($event->order_history->order_status_id, $status_completed)) {
            $order = Order::find($event->order_history->order_id);
            // Belki ilerleyen zamanda bir müşteri birden fazla kupon kullanabilir diye döngüye koydum.
            $order_coupons = $order->totals->where('key', 'coupon')->all();
            foreach ($order_coupons as $order_coupon) {
                preg_match('/\((.*?)\)/i', $order_coupon->name, $code);
                if (isset($code[1])) {
                    $code = $code[1];
                    $coupon = Coupon::where('code', $code)->first();
                    if ($coupon) {
                        \App\Model\Coupons\CouponHistory::create([
                            'coupon_id' => $coupon->id(),
                            'order_id' => $order->id(),
                            'customer_id' => $order->customer_id,
                            'amount' => $order_coupon->price
                        ]);
                    }
                }
            }
        }
    }
}
