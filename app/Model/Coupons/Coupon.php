<?php

namespace App\Model\Coupons;

use App\Model\Currencies\Currency;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'status', 'name', 'code', 'type', 'discount', 'total', 'start_date', 'end_date', 'uses_total', 'uses_customer'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function categories()
    {
        return $this->hasMany('App\Model\Coupons\CouponCategory', 'coupon_id');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Coupons\CouponProduct', 'coupon_id');
    }

    public function histories()
    {
        return $this->hasMany('App\Model\Coupons\CouponHistory', 'coupon_id');
    }

    public function getMethodName()
    {
        return 'Kupon İndirimi (' . $this->code . ')';
    }

    public function getKey()
    {
        return 'coupon';
    }

    public static function uses($code)
    {
        $errors = [];

        Cart::removeConditionsByType('coupon');

        $coupon = Coupon::where([
            'status' => 1,
            'code' => $code
        ])->where(function ($query) {
            $query->where(function ($query) {
                $query->where('start_date', null)
                    ->orWhereDate('start_date', '>=', Carbon::now());
            })->orWhere(function ($query) {
                $query->where('end_date', null)
                    ->orWhereDate('end_date', '>=', Carbon::now());
            });
        })->first();

        if (!$coupon) {
            $errors['coupon'] = 'Geçersiz kupon kodu';
        }

        if ($coupon) {
            if ($coupon->categories->count() > 0) {
                // todo: categori ürünlerinden biri varsa kullanacak
            }

            if ($coupon->products->count() > 0) {
                // todo: ürünlerden biri varsa kullanacak
            }

            if ($coupon->histories->count() > $coupon->uses_total) {
                $errors['total'] = 'Girilen kupon kodu tükenmiştir.';
            }

            if (Cart::getSubTotal() < $coupon->total) {
                $errors['total'] = 'Bu kuponu kullanabilmek için sepet tutarınızın en az ' . Currency::format($coupon->total) . ' olması gerekmektedir.';
            }

            if (auth()->check()) {
                if ($coupon->histories->where('customer_id', auth()->id())->count() >= $coupon->uses_customer) {
                    $errors['total'] = 'Bu kuponu toplamda ' . $coupon->uses_customer . ' adet kullanabilirsiniz';
                }
            }
        }

        if (count($errors) < 1) {
            if ($coupon->type == 'percent') {
                $discount = -($coupon->discount * Cart::getSubTotal()) / 100;
                //$discount = -($coupon->discount) . '%';
            } else {
                $discount = -$coupon->discount;
            }

            $condition = new CartCondition([
                'name' => 'Kupon İndirimi (' . $code . ')',
                'type' => 'coupon',
                'target' => 'total',
                'value' => $discount,
                'order' => 1,
                'attributes' => [
                    'class' => $coupon,
                    'coupon_id' => $coupon->id(),
                    'value' => $coupon->type,
                    'discount' => $coupon->discount,
                    'code' => $code
                ]
            ]);
            Cart::condition($condition);

            $results = [
                'status' => 1,
                'errors' => [],
                'coupon' => $coupon,
                'message' => 'Tebrikler Kupon indirimi uygulandı'
            ];
        } else {
            $results = [
                'status' => 0,
                'errors' => $errors,
                'coupon' => false,
                'message' => 'Hatalar Var'
            ];
        }

        return $results;
    }
}
