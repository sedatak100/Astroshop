<?php

namespace App\Model\Units;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $primaryKey = 'weight_id';

    protected $fillable = [
        'weight_id', 'name', 'unit', 'value'
    ];

    public static $config_key = 'config.weight';

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function isDefault()
    {
        if (config(self::$config_key) == $this->id()) {
            return true;
        }
        return false;
    }

    public function getConfigKey()
    {
        return self::$config_key;
    }
}
