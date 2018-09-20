<?php

namespace App\Model\Products;

use App\Model\Currencies\Currency;
use App\Model\Taxes\TaxClass;
use Illuminate\Database\Eloquent\Model;

class ProductCampaign extends Model
{
    protected $primaryKey = 'product_campaign_id';

    protected $fillable = [
        'product_id', 'customer_group_id', 'price', 'start_date', 'end_date', 'priority'
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

    public function rate($price, $currency_id)
    {
        if ($this->calcPrice($currency_id) < $price) {
            return round(100 - (100 / $price) * $this->calcPrice($currency_id));
        }
        return 0;
    }
}
