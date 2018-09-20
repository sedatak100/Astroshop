<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class ProductDownload extends Model
{
    protected $primaryKey = 'product_download_id';

    protected $fillable = [
        'product_id', 'download_id'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }
}
