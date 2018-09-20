<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Http\Controllers\FrontendController;
use App\Model\Products\Brand;
use App\Model\Products\Category;
use App\Model\Products\FormFilter;
use App\Model\Products\FormOrder;
use App\Model\Products\ProductTag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends FrontendController
{
    public function products($seo_name, Request $request)
    {
        $blade = [];

        $brand = Brand::where([
            'status' => 1,
            'seo_name' => $seo_name
        ])->firstOrFail();
        $blade['brand'] = $brand;

        $products = $brand->products()->where('status', 1)->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        });
        $products = FormFilter::formFilter($products, $request);
        $products = FormOrder::order($products, $request);
        $products = $products->paginate(12);
        $blade['products'] = $products;

        view()->share('breadcrumbs', [
            ['name' => $brand->name, 'link' => route('frontend.product.brand.products', ['seo_name' => $brand->name])]
        ]);

        $categories = Category::where([
            'status' => 1,
            'parent_id' => 0
        ])->get();
        $blade['categories'] = $categories;

        $brands = Brand::where('status', 1)->get();
        $blade['brands'] = $brands;

        $tags = ProductTag::limit(10)->get();
        $blade['tags'] = $tags;

        return view('frontend.products.brand_lists', $blade);
    }
}
