<?php

namespace App\Model\Statuses;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StockStatus extends Model
{
    protected $primaryKey = 'stock_status_id';

    protected $fillable = [
        'stock_status_id', 'name'
    ];

    public static $config_key = 'config.stock_status';

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
