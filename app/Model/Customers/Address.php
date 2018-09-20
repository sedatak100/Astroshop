<?php

namespace App\Model\Customers;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'customer_id', 'country_id', 'city_id', 'district_id', 'title', 'firstname', 'lastname', 'company',
        'address1', 'address2', 'postcode'
    ];

    protected $hidden = [
        'password', 'remember_token'
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
