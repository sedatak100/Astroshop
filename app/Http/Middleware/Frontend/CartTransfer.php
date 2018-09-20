<?php

namespace App\Http\Middleware\Frontend;

use App\Model\Carts\Basket;
use App\Model\Carts\DatabaseStorageModel;
use Closure;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartTransfer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->check()) {
            if (auth()->id() != session('cart_session_id')) {
                $old_items = Cart::getContent();
                if ($old_items->count() > 0) {
                    foreach ($old_items as $old_item) {
                        Cart::session(auth()->id());
                        Basket::add($old_item->id, $old_item->quantity);
                    }
                }
                DatabaseStorageModel::whereIn('id', [
                    session('cart_session_id') . '_cart_conditions',
                    session('cart_session_id') . '_cart_items',
                ])->delete();
            }
            session()->put('cart_session_id', auth()->id());
        }

        return $next($request);
    }
}
