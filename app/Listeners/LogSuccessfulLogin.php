<?php

namespace App\Listeners;

use App\Http\Controllers\Frontend\Carts\CouponController;
use App\Model\Carts\Basket;
use App\Model\Carts\DatabaseStorageModel;
use App\Model\Carts\DBStorage;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
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
     * @param  Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        /*
        // Sepet Aktarımı
        $session_key = session('cart_session_id');
        if (Cart::session($session_key)->getContent()->count() > 0) {

            DatabaseStorageModel::whereIn('id', [
                auth()->id() . '_cart_conditions',
                auth()->id() . '_cart_items',
            ])->delete();

            $db_storage = new DBStorage();

            DatabaseStorageModel::where([
                'id' => $session_key . '_cart_items',
            ])->update([
                'id' => auth()->id() . '_cart_items'
            ]);

            DatabaseStorageModel::where([
                'id' => $session_key . '_cart_conditions',
            ])->update([
                'id' => auth()->id() . '_cart_conditions'
            ]);

            $cart_items = $db_storage->get(auth()->id() . '_cart_items');

            if ($cart_items) {
                foreach ($cart_items as $cart_item) {
                    config()->set('config.customer_group', auth()->user()->customer_group_id);
                    Cart::session(auth()->id());
                    Basket::add($cart_item->id, $cart_item->quantity, true);
                }
            }

        }
        */
    }
}
