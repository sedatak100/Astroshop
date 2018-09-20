<?php

namespace App\Model\Products;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'status', 'name', 'seo_name', 'description', 'image', 'icon', 'meta_title', 'meta_description', 'meta_keyword',
        'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function products()
    {
        return $this->hasMany('App\Model\Products\Product', 'brand_id', 'brand_id');
    }
}
