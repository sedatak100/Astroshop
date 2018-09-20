<?php

namespace App\Model\Regions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RegionScope extends Model
{
    protected $primaryKey = 'region_id';

    protected $fillable = [
        'region_scope_id', 'region_id', 'country_id', 'city_id'
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
