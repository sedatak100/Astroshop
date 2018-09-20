<?php

namespace App\Model\Orders;

use App\Model\Currencies\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    protected $primaryKey = 'order_total_id';

    protected $fillable = [
        'order_id',
        'name',
        'key',
        'price',
        'order',
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function priceFormat()
    {
        return Currency::format($this->price);
    }
}
