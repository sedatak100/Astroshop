<?php

namespace App\Model\Customers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'status', 'customer_group_id', 'firstname', 'lastname', 'email', 'password', 'phone', 'gsm', 'fax',
        'address_id', 'last_login_ip', 'last_login_date', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
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

    public function lastLoginDate()
    {
        return Carbon::parse($this->last_login_date)->format(config('app.datetime_format'));
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function group($columns = ['*'])
    {
        return CustomerGroup::find($this->customer_group_id, $columns);
    }

    /*
     * todo: burası önceden böyleydi. relationship çeverdim kullanıldığı yerlerdede düzelt
    public function addresses($columns = ['*'])
    {
        return Address::where('customer_id', $this->id())->get($columns);
    }
    */

    public function addresses()
    {
        return $this->hasMany('App\Model\Customers\Address', 'customer_id', 'customer_id');
    }
}
