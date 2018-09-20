<?php

namespace App\Model\Orders;

use App\Model\Currencies\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $primaryKey = 'order_product_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'model',
        'quantity',
        'price',
        'tax',
        'total',
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function priceWithTax()
    {
        return $this->price + $this->tax;
    }

    public function priceWithTaxFormat()
    {
        return Currency::format($this->priceWithTax());
    }

    public function totalFormat()
    {
        return Currency::format($this->total);
    }
}
