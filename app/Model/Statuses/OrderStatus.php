<?php

namespace App\Model\Statuses;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $primaryKey = 'order_status_id';

    protected $fillable = [
        'order_status_id', 'name'
    ];

    public static $config_key = 'config.order_status';

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
