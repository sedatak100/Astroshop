<?php

namespace App\Model\Taxes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxRateCustomerGroup extends Model
{
    protected $primaryKey = 'tax_rate_customer_group_id';

    protected $fillable = [
        'tax_rate_id', 'customer_group_id'
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
}
