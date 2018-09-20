<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $primaryKey = 'attribute_group_id';

    protected $fillable = [
        'status', 'name', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function countAttribute()
    {
        return Attribute::where('attribute_group_id', $this->id())->count();
    }

    public function attributes()
    {
        return Attribute::where('attribute_group_id', $this->id())->get();
    }
}
