<?php

namespace App\Model\Configs;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $primaryKey = 'config_id';

    protected $fillable = [
        'user_group_id', 'group', 'key', 'value', 'serialized'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
