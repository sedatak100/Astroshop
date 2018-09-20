<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $primaryKey = 'product_category_id';

    protected $fillable = [
        'product_id', 'category_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Products\Category', 'category_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Model\Products\Product', 'product_id');
    }
}
