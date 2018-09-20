<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Http\Controllers\FrontendController;
use App\Model\Products\Product;
use App\Model\Statuses\StockStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends FrontendController
{
    public function view($seo_name)
    {
        $blade = [];

        $product = Product::with(['attributes' => function ($query) {
            $query->where('status', 1);
        }])->with(['icons' => function ($query) {
            $product_detail_icons = config('theme.product_detail_icons') ?? [];
            $query->where('icons.icon_id', $product_detail_icons);
        }])->with(['downloads' => function ($query) {
            $query->where('based', 'order_before');
        }])->with(['similars' => function ($query) {
            $query->where('status', 1);
        }])->where([
            'status' => 1,
            'seo_name' => $seo_name
        ])->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        })->firstOrFail();

        if ($product->similars->count() > 0) {
            $product->similars->map(function ($product) {
                return $product['product_id'] = $product->similar_id;
            });
        }

        $blade['product'] = $product;

        // BreadCrumbs
        view()->share('breadcrumbs', [
            ($product->categories) ?
                [
                    'name' => $product->categories->first()->name, 'link' => route('frontend.product.category.lists', [
                    'seo_name' => $product->categories->first()->seo_name])
                ] : '',
            [
                'name' => $product->brand->name, 'link' => route('frontend.product.brand.products', [
                'seo_name' => $product->brand->seo_name])
            ],
            ['name' => $product->name, 'link' => route('frontend.product.view', ['seo_name' => $product->seo_name])]
        ]);

        // Stok Durumu
        if ($product->quantity > 0) {
            $stock_status_id = config('config.stock_status');
        } else {
            $stock_status_id = $product->stock_status_id;
        }
        $stock_status = StockStatus::find($stock_status_id);
        $blade['stock_status'] = $stock_status;

        return view('frontend.products.product_view', $blade);
    }
}
