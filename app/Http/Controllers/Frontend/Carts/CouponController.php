<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Http\Controllers\FrontendController;
use App\Model\Coupons\Coupon;
use App\Model\Currencies\Currency;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class CouponController extends FrontendController
{
    public function uses(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
        ]);

        $code = $request->post('code');

        $uses = Coupon::uses($code);
        if ($uses['status'] == 1) {
            session()->put('coupon_code', $code);
            return redirect()->back()->withSuccess($uses['message']);
        } else {
            foreach ($uses['errors'] as $key => $value) {
                $validator->errors()->add($key, $value);
            }
            return redirect()->back()->withErrors($validator);
        }
    }

    public function remove()
    {
        session()->remove('coupon_code');
        Cart::removeConditionsByType('coupon');
        return redirect()->back()->withSuccess('Kupon indirimi iptal edildi.');
    }
}
