<?php

namespace App\Model\Products;

use App\Model\Currencies\Currency;
use App\Model\Taxes\TaxClass;
use App\Model\Images\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'status', 'name', 'seo_name', 'short_description', 'description', 'meta_title', 'meta_keyword',
        'meta_description', 'image', 'brand_id', 'model', 'stock_code', 'barcode', 'serial_no', 'serial_no2',
        'serial_no3', 'price', 'currency_id', 'quantity', 'min_quantity', 'subtract', 'stock_status_id', 'shipping',
        'tax_class_id', 'date_available', 'length', 'width', 'height', 'length_id', 'weight',
        'weight_id', 'order',
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    /**
     * Ürüne ait kategoriler
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Category',
            'App\Model\Products\ProductCategory',
            'product_id',
            'category_id',
            'product_id',
            'category_id'
        )->orderBy('order', 'ASC');
    }

    /**
     * Ürüne ait dosyalar
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function downloads()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Download',
            'App\Model\Products\ProductDownload',
            'product_id',
            'download_id',
            'product_id',
            'download_id'
        );
    }

    /**
     * Ürüne ait ikonlar
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function icons()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Icon',
            'App\Model\Products\ProductIcon',
            'product_id',
            'icon_id',
            'product_id',
            'icon_id'
        );
    }

    /**
     * Ürüne ait ikon
     * @param $icon_id
     * @param array $columns
     * @return null
     */
    public function icon($icon_id)
    {
        $query = $this->icons->find($icon_id);
        if ($query) {
            return $query;
        }
        return null;
    }

    /**
     * Ürüne ait filtreler
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function filters()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Filter',
            'App\Model\Products\ProductFilter',
            'product_id',
            'filter_id',
            'product_id',
            'filter_id'
        )->orderBy('order', 'ASC');
    }

    /**
     * Ürüne ait benzer ürünler
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function similars()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Product',
            'App\Model\Products\ProductSimilar',
            'product_id',
            'product_id',
            'product_id',
            'similar_id'
        )->select('products.*', 'product_similars.similar_id')->orderBy('order', 'ASC');
    }

    /**
     * Ürüne ait etiketler
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Model\Products\ProductTag', 'product_id');
    }

    /**
     * Ürüne ait özellikler
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function attributes()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Attribute',
            'App\Model\Products\ProductAttribute',
            'product_id',
            'attribute_id',
            'product_id',
            'attribute_id'
        )->select(['product_attributes.*', 'attributes.*'])
            ->orderBy('order', 'ASC');
    }

    /**
     * Ürüne ait indirimler
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discounts()
    {
        return $this->hasMany('App\Model\Products\ProductDiscount', 'product_id');
    }

    /**
     * Ürüne ait kampanyalar
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany('App\Model\Products\ProductCampaign', 'product_id');
    }

    /**
     * Ürüne ait geçerli kampanyayı bulur
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentCampaign()
    {
        return $this->hasOne('App\Model\Products\ProductCampaign', 'product_id')->where(function ($query) {
            $query->where(function ($query) {
                $query->where('start_date', null)
                    ->orWhereDate('start_date', '>=', Carbon::now());
            })->orWhere(function ($query) {
                $query->where('end_date', null)
                    ->orWhereDate('end_date', '>=', Carbon::now());
            });
        })->where('customer_group_id', config('config.customer_group'))
            ->orderBy('priority', 'ASC');
    }

    public function currentDiscounts()
    {
        return $this->discounts()->where(function ($query) {
            $query->where(function ($query) {
                $query->where('start_date', null)
                    ->orWhereDate('start_date', '>=', Carbon::now());
            })->orWhere(function ($query) {
                $query->where('end_date', null)
                    ->orWhereDate('end_date', '>=', Carbon::now());
            });
        })->where('customer_group_id', config('config.customer_group'))->groupBy('quantity')
            ->orderBy('priority', 'ASC')
            ->orderBy('quantity', 'DESC');
    }

    /**
     * Ürüne ait resimler
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Model\Products\ProductImage', 'product_id')->orderBy('order', 'ASC');
    }

    /**
     * Ürüne ait marka
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Model\Products\Brand', 'brand_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Model\Currencies\Currency', 'currency_id');
    }

    public function calcPrice()
    {
        return Currency::format($this->price, $this->currency_id, '', false);
    }

    /**
     * Ürün Formatı
     * @return float|int|string
     */
    public function priceFormat()
    {
        return Currency::format(TaxClass::calc($this->calcPrice(), $this->tax_class_id));
    }

    /**
     * @param $dimension_name
     * @return string
     */
    public function getImageUrl($dimension_name)
    {
        $dimension = config('product_image.' . $dimension_name);
        if ($dimension) {
            return Image::resize($this->image, $dimension['x'], $dimension['y']);
        }
        return '';
    }
}
