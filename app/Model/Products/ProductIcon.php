<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductIcon extends Model
{
    protected $primaryKey = 'product_icon_id';

    protected $fillable = [
        'product_id', 'icon_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function icon()
    {
        return $this->belongsTo('App\Model\Products\Icon', 'product_icon_id', 'icon_id');
    }
}
