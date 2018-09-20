<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Http\Controllers\FrontendController;
use App\Model\Products\Brand;
use App\Model\Products\Category;
use App\Model\Products\FormFilter;
use App\Model\Products\FormOrder;
use App\Model\Products\Product;
use App\Model\Products\ProductTag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends FrontendController
{
    public function lists($seo_name, Request $request)
    {
        $blade = [];
        $category = Category::where('status', 1)
            ->with(['attributes' => function ($query) {
                $query->where('status', 1);
            }])->where('seo_name', $seo_name)
            ->firstOrFail();
        $blade['category'] = $category;

        $category_ids[] = $category->id();
        if ($category->childrens->count() > 0) {
            $category_ids = array_merge($category_ids, $category->childrens->pluck('category_id')->toArray());
        }

        $products = Product::where([
            'status' => 1,
        ])->whereHas('categories', function ($query) use ($category_ids) {
            $query->whereIn('categories.category_id', $category_ids);
        })->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        });

        $products = FormFilter::formFilter($products, $request);
        $products = FormOrder::order($products, $request);
        $products = $products->paginate(12);

        $blade['products'] = $products;
        view()->share('breadcrumbs', array_merge([
        ], $category->frontendBreadcrumbs()));

        $categories = Category::where([
            'status' => 1,
            'parent_id' => $category->parent_id
        ])->get();
        $blade['categories'] = $categories;

        $brands = Brand::where('status', 1)->get();
        $blade['brands'] = $brands;

        $tags = ProductTag::limit(10)->get();
        $blade['tags'] = $tags;

        return view('frontend.products.category_lists', $blade);
    }
}
