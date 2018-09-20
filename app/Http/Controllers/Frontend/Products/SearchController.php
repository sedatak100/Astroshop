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

class SearchController extends FrontendController
{
    public function lists(Request $request)
    {
        $blade = [];

        if (!$request->has('term')) {
            redirect()->route('frontend.home.index');
        }

        $term = $request->input('term');
        $blade['term'] = $term;

        $request_input = $request->input();
        $request->request->add(['f' => ['name' => $term] +
            (is_array($request->has('f')) ? $request->input('f') : [])]);

        $products = Product::where('status', 1)->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        });
        $products = FormFilter::formFilter($products, $request);
        $products = FormOrder::order($products, $request);
        $products = $products->paginate(12);

        $request->request->add($request_input);
        $blade['products'] = $products;

        view()->share('breadcrumbs', [
            ['name' => $term, 'link' => route('frontend.product.search.lists', ['term' => $term])]
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

        return view('frontend.products.search_lists', $blade);
    }
}
