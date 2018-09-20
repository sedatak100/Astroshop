<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductSimilar extends Model
{
    protected $primaryKey = 'product_similar_id';

    protected $fillable = [
        'product_id', 'similar_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
