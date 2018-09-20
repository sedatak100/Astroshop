<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $primaryKey = 'product_attribute_id';

    protected $fillable = [
        'product_id', 'attribute_id', 'value'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
