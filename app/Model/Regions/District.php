<?php

namespace App\Model\Regions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $primaryKey = 'district_id';

    protected $fillable = [
        'district_id', 'status', 'country_id', 'city_id', 'name', 'code', 'order'
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

    public function country($status = false, $columns = ['*'])
    {
        $country = new Country();
        if ($status !== false) {
            $country->where('status', $status);
        }
        return $country->find($this->country_id, $columns);
    }

    public function city($status = false, $columns = ['*'])
    {
        $city = new City();
        if ($status !== false) {
            $city->where('status', $status);
        }
        return $city->find($this->city_id, $columns);
    }
}
