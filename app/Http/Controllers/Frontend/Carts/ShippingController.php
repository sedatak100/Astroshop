<?php

namespace App\Http\Controllers\Frontend\Carts;

use App\Model\Customers\Address;
use App\Model\Orders\Order;
use App\Model\Orders\OrderProduct;
use App\Model\Orders\OrderTotal;
use App\Model\PaymentMethods\PaymentMethod;
use App\Model\Products\Product;
use App\Model\Regions\District;
use App\Model\ShippingMethods\ShippingMethod;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function view()
    {
        $blade = [];

        view()->share('breadcrumbs', [
            ['name' => 'Sepetim', 'link' => route('frontend.cart.basket.view')],
            ['name' => 'Teslimat ve Fatura Bilgileri', 'link' => ''],
        ]);

        if (auth()->check()) {
            $shipping_address = auth()->user()->addresses->where('title', 'shipping')->first();
            $payment_address = auth()->user()->addresses->where('title', 'payment')->first();
        } else {
            $shipping_address = false;
            $payment_address = false;
        }
        $blade['shipping_address'] = $shipping_address;
        $blade['payment_address'] = $payment_address;

        // Geçerli Kargo Methodu
        ShippingMethod::currentShipping();

        // Ürünler
        $cart_items = Cart::getContent();

        if ($cart_items->count() < 1) {
            return redirect(route('frontend.cart.basket.view'));
        }

        $cart_items->each(function ($cart_item) {
            $product = Product::with(['brand', 'categories'])->find($cart_item->id);
            $cart_item->put('product', $product);
        });
        $blade['cart_items'] = $cart_items;

        // Ödeme Methodları
        $payment_methods = PaymentMethod::useAll();
        $blade['payment_methods'] = $payment_methods;

        return view('frontend.carts.shipping_view', $blade);
    }

    public function added(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if (auth()->guest()) {
            $request->validate([
                'email' => 'required|email',
                'phone' => 'numeric',
                'gsm' => 'required|numeric',
            ]);
        }

        $request->validate([
            'shipping.firstname' => 'required|string',
            'shipping.lastname' => 'required|string',
            'shipping.country_id' => 'required|integer',
            'shipping.city_id' => 'required|integer',
            'shipping.district_id' => 'required|integer',
            'shipping.address1' => 'required',
            'shipping.postcode' => 'required|numeric',
            'shipping_payment_same' => 'numeric'
        ]);

        if ($request->post('shipping_payment_same') == 1) {
            $request->validate([
                'payment.firstname' => 'required|string',
                'payment.lastname' => 'required|string',
                'payment.country_id' => 'required|integer',
                'payment.city_id' => 'required|integer',
                'payment.district_id' => 'required|integer',
                'payment.address1' => 'required',
                'payment.postcode' => 'required|numeric',
            ]);
        }

        $request->validate([
            'payment_method' => 'required',
        ]);

        $cart_items = Cart::getContent();
        if ($cart_items->count() < 1) {
            $validator->errors()->add('shipping_condition', 'Lütfen ilk önce sepetinize ürün ekleyiniz');
        }

        $shipping_condition = Cart::getCondition('Kargo Ücreti');

        if (!$shipping_condition) {
            $validator->errors()->add('shipping_condition', 'Lütfen kargo seçimi yapınız');
        }

        $payment_method = PaymentMethod::getUseMethod($request->input('payment_method'));
        if (!$payment_method) {
            $validator->errors()->add('shipping_condition', 'Lütfen ödeme şeklini seçiniz');
        }

        if ($validator->errors()->count() > 0) {
            return redirect()->route('frontend.cart.shipping.view')->withErrors($validator);
        }

        $shipping_country = false;
        $shipping_city = false;
        $shipping_district = District::find($request->input('shipping.district_id'));
        if ($shipping_district) {
            $shipping_city = $shipping_district->city();
            $shipping_country = $shipping_district->country();
        }

        $payment_country = false;
        $payment_city = false;
        $payment_district = District::find($request->input('payment.district_id'));
        if ($payment_district) {
            $payment_city = $payment_district->city();
            $payment_country = $payment_district->country();
        }

        $shipping_address = false;
        $payment_address = false;
        if (auth()->check()) {
            $shipping_address = Address::updateOrCreate([
                'customer_id' => auth()->id(),
                'title' => 'shipping'
            ], [
                'customer_id' => auth()->id(),
                'firstname' => $request->input('shipping.firstname'),
                'lastname' => $request->input('shipping.lastname'),
                'country_id' => $request->input('shipping.country_id'),
                'city_id' => $request->input('shipping.city_id'),
                'district_id' => $request->input('shipping.district_id'),
                'title' => 'shipping',
                'address1' => $request->input('shipping.address1'),
                'address2' => $request->input('shipping.address2'),
                'postcode' => $request->input('shipping.postcode')
            ]);

            if ($request->post('shipping_payment_same') == 1) {
                $payment_address = Address::updateOrCreate([
                    'customer_id' => auth()->id(),
                    'title' => 'payment'
                ], [
                    'customer_id' => auth()->id(),
                    'firstname' => $request->input('payment.firstname'),
                    'lastname' => $request->input('payment.lastname'),
                    'country_id' => $request->input('payment.country_id'),
                    'city_id' => $request->input('payment.city_id'),
                    'district_id' => $request->input('payment.district_id'),
                    'title' => 'payment',
                    'address1' => $request->input('payment.address1'),
                    'address2' => $request->input('payment.address2'),
                    'postcode' => $request->input('payment.postcode')
                ]);
            }
        }

        $shipping_attributes = $shipping_condition->getAttributes();

        $save = [
            'customer_id' => auth()->check() ? auth()->id() : 0,
            'customer_group_id' => auth()->check() ? auth()->user()->customer_group_id : 0,
            'firstname' => auth()->check() ? auth()->user()->firstname : $request->input('shipping.firstname'),
            'lastname' => auth()->check() ? auth()->user()->lastname : $request->input('shipping.lastname'),
            'email' => auth()->check() ? auth()->user()->email : $request->input('email'),
            'phone' => auth()->check() ? auth()->user()->phone : $request->input('phone'),
            'gsm' => auth()->check() ? auth()->user()->gsm : $request->input('gsm'),
            'fax' => auth()->check() ? auth()->user()->fax : '',
            'shipping_method' => $shipping_attributes['class']->getMethodName(),
            'shipping_key' => $shipping_attributes['class']->getKey(),
            'shipping_address_id' => $shipping_address ? $shipping_address->id() : 0,
            'shipping_country_id' => $shipping_country ? $shipping_country->id() : 0,
            'shipping_country' => $shipping_country ? $shipping_country->name : '',
            'shipping_city_id' => $shipping_city ? $shipping_city->id() : 0,
            'shipping_city' => $shipping_city ? $shipping_city->name : '',
            'shipping_district_id' => $shipping_district ? $shipping_district->id() : 0,
            'shipping_district' => $shipping_district ? $shipping_district->name : '',
            'shipping_firstname' => $request->input('shipping.firstname'),
            'shipping_lastname' => $request->input('shipping.lastname'),
            'shipping_company' => '',
            'shipping_address1' => $request->input('shipping.address1'),
            'shipping_address2' => $request->input('shipping.address2'),
            'shipping_postcode' => $request->input('shipping.postcode'),
            'payment_method' => $payment_method->getMethodName(),
            'payment_key' => $payment_method->getKey(),
            'payment_address_id' => $payment_address ? $payment_address->id() : 0,
            'note' => $request->input('note'),
            'total' => Cart::getTotal(),
            'order_status_id' => 0,
            'currency_id' => config('currencies')->find(config('config.currency'))->id(),
            'currency_code' => config('currencies')->find(config('config.currency'))->code,
            'currency_value' => config('currencies')->find(config('config.currency'))->value,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ];

        if ($request->post('shipping_payment_same') == 1) {
            $payment_save = [
                'payment_country_id' => $payment_country ? $payment_country->id() : 0,
                'payment_country' => $payment_country ? $payment_country->name : '',
                'payment_city_id' => $payment_city ? $payment_city->id() : 0,
                'payment_city' => $payment_city ? $payment_city->name : '',
                'payment_district_id' => $payment_district ? $payment_district->id() : 0,
                'payment_district' => $payment_district ? $payment_district->name : '',
                'payment_firstname' => $request->input('payment.firstname'),
                'payment_lastname' => $request->input('payment.lastname'),
                'payment_company' => '',
                'payment_address1' => $request->input('payment.address1'),
                'payment_address2' => $request->input('payment.address2'),
                'payment_postcode' => $request->input('payment.postcode'),
            ];
        } else {
            $payment_save = [
                'payment_country_id' => $shipping_country ? $shipping_country->id() : 0,
                'payment_country' => $shipping_country ? $shipping_country->name : '',
                'payment_city_id' => $shipping_city ? $shipping_city->id() : 0,
                'payment_city' => $shipping_city ? $shipping_city->name : '',
                'payment_district_id' => $shipping_district ? $shipping_district->id() : 0,
                'payment_district' => $shipping_district ? $shipping_district->name : '',
                'payment_firstname' => $request->input('shipping.firstname'),
                'payment_lastname' => $request->input('shipping.lastname'),
                'payment_company' => '',
                'payment_address1' => $request->input('shipping.address1'),
                'payment_address2' => $request->input('shipping.address2'),
                'payment_postcode' => $request->input('shipping.postcode'),
            ];
        }
        $save = array_merge($save, $payment_save);

        $order = Order::create($save);

        $cart_items = Cart::getContent();
        $cart_items->each(function ($cart_item) use ($order) {
            OrderProduct::create([
                'order_id' => $order->id(),
                'product_id' => $cart_item->id,
                'name' => $cart_item->name,
                'model' => $cart_item->attributes->model,
                'quantity' => $cart_item->quantity,
                'price' => $cart_item->price,
                'tax' => $cart_item->conditions->getValue(),
                'total' => $cart_item->getPriceSumWithConditions()
            ]);
        });

        OrderTotal::create([
            'order_id' => $order->id(),
            'name' => 'Alışveriş Toplamı',
            'key' => 'sub_total',
            'price' => Cart::getSubTotal(),
            'order' => 0
        ]);

        foreach (Cart::getConditions() as $condition) {
            $attributes = $condition->getAttributes();
            OrderTotal::create([
                'order_id' => $order->id(),
                'name' => $condition->getName(),
                'key' => $attributes['class']->getKey(),
                'price' => $condition->getValue(),
                'order' => $condition->getOrder()
            ]);
        }

        OrderTotal::create([
            'order_id' => $order->id(),
            'name' => 'Genel Toplam',
            'key' => 'total',
            'price' => Cart::getTotal(),
            'order' => 10
        ]);
        session(['order' => $order]);
        return redirect()->route('frontend.cart.payment.view', ['id' => $order->id()]);
    }
}
