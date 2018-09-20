<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $primaryKey = 'filter_id';

    protected $fillable = [
        'filter_id', 'status', 'filter_group_id', 'name', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
