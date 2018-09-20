<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $primaryKey = 'product_tag_id';

    protected $fillable = [
        'product_id', 'name'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
