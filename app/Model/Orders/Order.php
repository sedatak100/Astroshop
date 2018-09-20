<?php

namespace App\Model\Orders;

use App\Model\Currencies\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'customer_group_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'gsm',
        'fax',
        'shipping_method',
        'shipping_key',
        'shipping_address_id',
        'shipping_country_id',
        'shipping_country',
        'shipping_city_id',
        'shipping_city',
        'shipping_district_id',
        'shipping_district',
        'shipping_firstname',
        'shipping_lastname',
        'shipping_company',
        'shipping_address1',
        'shipping_address2',
        'shipping_postcode',
        'payment_method',
        'payment_key',
        'payment_address_id',
        'payment_country_id',
        'payment_country',
        'payment_city_id',
        'payment_city',
        'payment_district_id',
        'payment_district',
        'payment_firstname',
        'payment_lastname',
        'payment_company',
        'payment_address1',
        'payment_address2',
        'payment_postcode',
        'note',
        'total',
        'order_status_id',
        'currency_id',
        'currency_code',
        'currency_value',
        'ip',
        'user_agent',
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function createdAt()
    {
        return Carbon::parse($this->created_at)->format(config('app.datetime_format'));
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function shippingFullname()
    {
        return $this->shipping_firstname . ' ' . $this->shipping_lastname;
    }

    public function paymentFullname()
    {
        return $this->payment_firstname . ' ' . $this->payment_lastname;
    }

    public function customer()
    {
        return $this->belongsTo('App\Model\Customers\Customer', 'customer_id', 'customer_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\Model\Statuses\OrderStatus', 'order_status_id', 'order_status_id');
    }

    public function totalFormat()
    {
        return Currency::format($this->total, $this->currency_id, $this->currency_value);
    }

    public function products()
    {
        return $this->hasMany('App\Model\Orders\OrderProduct', 'order_id', 'order_id');
    }

    public function totals()
    {
        return $this->hasMany('App\Model\Orders\OrderTotal', 'order_id', 'order_id')
            ->orderBy('order', 'ASC');
    }

    public function histories()
    {
        return $this->hasMany('App\Model\Orders\OrderHistory', 'order_id', 'order_id')
            ->orderBy('created_at', 'DESC');
    }
}
