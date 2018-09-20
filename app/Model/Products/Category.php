<?php

namespace App\Model\Products;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id', 'status', 'parent_id', 'name', 'description',
        'seo_name', 'meta_keyword', 'meta_description',
        'image', 'image2', 'image3', 'icon', 'meta_title',
        'meta_description', 'meta_keyword', 'order'
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
     * Kategoriye ait tüm alt kategoriler
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany('App\Model\Products\Category', 'parent_id')->with('childrens');
    }

    /**
     * Kategoriye ait bir alt kategori
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Model\Products\Category', 'parent_id');
    }

    /**
     * Kategoriye ait tüm üst kategoriler
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parents()
    {
        return $this->belongsTo('App\Model\Products\Category', 'parent_id')->with('parents');
    }

    /**
     * Kategoriye ait bir üst kategoriler
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Model\Products\Category', 'parent_id');
    }

    /**
     * breadcrumbs
     * @return array
     */
    public function breadcrumbs($based)
    {
        $breadcrumbs = [];
        $breadcrumb = [];
        $breadcrumb['name'] = $this->name;
        if ($based == 'backend') {
            $breadcrumb['link'] = route('backend.product.category.lists', ['id' => $this->id()]);
        } elseif ($based = 'frontend') {
            $breadcrumb['link'] = route('frontend.product.category.lists', ['seo_name' => $this->seo_name]);
        }
        array_push($breadcrumbs, $breadcrumb);
        $parents = $this->parents;
        if ($parents) {
            while (true) {
                $breadcrumb = [];
                $breadcrumb['name'] = $parents->name;

                if ($based == 'backend') {
                    $breadcrumb['link'] = route('backend.product.category.lists', ['id' => $parents->id()]);
                } elseif ($based = 'frontend') {
                    $breadcrumb['link'] = route('frontend.product.category.lists', ['seo_name' => $parents->seo_name]);
                }
                array_push($breadcrumbs, $breadcrumb);
                if ($parents->parents) {
                    $parents = $parents->parents;
                } else {
                    break;
                }
            }
        }
        return array_reverse($breadcrumbs);
    }

    /**
     * Backend breadcrumbs
     * @return array
     */
    public function backendBreadcrumbs()
    {
        return $this->breadcrumbs('backend');
    }

    /**
     * Frontend breadcrumbs
     * @return array
     */
    public function frontendBreadcrumbs()
    {
        return $this->breadcrumbs('frontend');
    }

    /**
     * Kategoriye ait alt kategori sayısı
     * @return int
     */
    public function countChildren()
    {
        return $this->where('parent_id', $this->id())->count();
    }

    /**
     * @param bool|int $status
     * @return int
     */
    public function countProduct($status = false)
    {
        $category_ids[] = $this->id();
        if ($this->childrens->count() > 0) {
            $category_ids = array_merge($category_ids, $this->childrens->pluck('category_id')->toArray());
        }


        if ($status !== false) {
            $products = Product::where([
                'status' => 1,
            ])->whereHas('categories', function ($query) use ($category_ids) {
                $query->whereIn('categories.category_id', $category_ids);
            })->where(function ($query) {
                $query->where('date_available', null)
                    ->orWhereDate('date_available', '>=', Carbon::now());
            });
        } else {
            $products = $this->products();
        }
        return $products->count();
    }

    /**
     * Kategoriye ait ürünler
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Product',
            'App\Model\Products\ProductCategory',
            'category_id',
            'product_id',
            'category_id',
            'product_id'
        )->orderBy('order', 'ASC');
    }

    public function attributes()
    {
        return $this->hasManyThrough(
            'App\Model\Products\Attribute',
            'App\Model\Products\CategoryAttribute',
            'category_id',
            'attribute_id',
            'category_id',
            'attribute_id'
        )->orderBy('order', 'ASC');
    }
}
