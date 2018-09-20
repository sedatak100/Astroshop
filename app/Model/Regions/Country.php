<?php

namespace App\Model\Regions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'country_id';

    protected $fillable = [
        'country_id', 'status', 'name', 'code', 'order'
    ];

    public static $default_config_key = 'config.default_country';

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

    public function isDefault()
    {
        if (config(self::$default_config_key) == $this->id()) {
            return true;
        }
        return false;
    }

    public function getDefaultConfigKey()
    {
        return self::$default_config_key;
    }

    public function cities($status = false, $columns = ['*'])
    {
        $city = City::where('country_id', $this->id());
        if ($status !== false) {
            $city->where('status', $status);
        }
        return $city->get($columns);
    }

    public function totalCity()
    {
        return City::where('country_id', $this->id())->count();
    }

    public function totalDistrict()
    {
        return District::where('country_id', $this->id())->count();
    }
}
