<?php

namespace App\Model\Regions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';

    protected $fillable = [
        'city_id', 'status', 'country_id', 'name', 'code', 'order'
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

    public function districts($status = false, $columns = ['*'])
    {
        $district = District::where('city_id', $this->id());
        if ($status !== false) {
            $district->where('status', $status);
        }
        return $district->get($columns);
    }

    public function totalDistrict()
    {
        return District::where('city_id', $this->id())->count();
    }

    public function country($columns = ['*'])
    {
        return Country::find($this->country_id, $columns);
    }
}
