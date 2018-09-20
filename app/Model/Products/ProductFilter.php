<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    protected $primaryKey = 'product_filter_id';

    protected $fillable = [
        'product_id', 'filter_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
