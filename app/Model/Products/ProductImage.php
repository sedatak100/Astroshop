<?php

namespace App\Model\Products;

use App\Model\Images\Image;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $primaryKey = 'product_image_id';

    protected $fillable = [
        'product_id', 'image', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    /**
     * @param $dimension_name
     * @return string
     */
    public function getImageUrl($dimension_name)
    {
        $dimension = config('product_image.' . $dimension_name);
        if ($dimension && $this->image) {
            return Image::resize($this->image, $dimension['x'], $dimension['y']);
        }
        return '';
    }
}
