<?php

namespace App\Model\Products;

use App\Model\Currencies\Currency;
use App\Model\Taxes\TaxClass;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    protected $primaryKey = 'product_discount_id';

    protected $fillable = [
        'product_id', 'customer_group_id', 'price', 'quantity', 'start_date', 'end_date', 'priority'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function calcPrice($currency_id)
    {
        return Currency::format($this->price, $currency_id, '', false);
    }

    public function priceFormat($tax_class_id, $currency_id)
    {
        return Currency::format(TaxClass::calc($this->calcPrice($currency_id), $tax_class_id));
    }
}
