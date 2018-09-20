<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $primaryKey = 'attribute_id';

    protected $fillable = [
        'attribute_id', 'status', 'attribute_group_id', 'name', 'type', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public static function types()
    {
        return [
            'select' => 'SelectBox',
            'between' => 'Between'
        ];
    }

    public function group()
    {
        return $this->belongsTo('App\Model\Products\AttributeGroup', 'attribute_group_id');
    }

    public function minVal()
    {
        return $this->hasOne('App\Model\Products\ProductAttribute', 'attribute_id')
            ->orderBy('value', 'ASC');
    }

    public function maxVal()
    {
        return $this->hasOne('App\Model\Products\ProductAttribute', 'attribute_id')
            ->orderBy('value', 'DESC');
    }

    public function values()
    {
        return $this->hasMany('App\Model\Products\ProductAttribute', 'attribute_id')
            ->orderBy('value', 'ASC');
    }

    public function categoryValues()
    {
        return $this->hasManyThrough(
            'App\Model\Products\ProductAttribute',
            'App\Model\Products\ProductCategory',
            'product_attributes.attribute_id',
            'product_id',
            'attribute_id',
            'product_id'
        )->where('category_id', $this->category_id)->groupBy('value');
    }
}
