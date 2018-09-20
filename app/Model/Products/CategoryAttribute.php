<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    protected $primaryKey = 'category_attribute_id';

    protected $fillable = [
        'category_id', 'attribute_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
