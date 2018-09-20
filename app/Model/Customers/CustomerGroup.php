<?php

namespace App\Model\Customers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $primaryKey = 'customer_group_id';

    protected $fillable = [
        'customer_group_id', 'name', 'description', 'approval', 'order'
    ];

    public static $config_default_key = 'config.customer_group';

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
        if (config(self::$config_default_key) == $this->id()) {
            return true;
        }
        return false;
    }

    public function getDefaultConfigKey()
    {
        return self::$config_default_key;
    }
}
