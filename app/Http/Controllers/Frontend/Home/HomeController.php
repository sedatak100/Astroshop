<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\FrontendController;
use App\Model\Customers\Customer;
use App\Model\Pages\Page;
use App\Model\Posters\PosterGroup;
use App\Model\Products\Category;
use App\Model\Products\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends FrontendController
{
    public function index()
    {
        $blade = [];

        //Kategoriler.
        $home_categories = config('theme.home_categories') ?? [];
        $categories = Category::where('status', 1)->whereIn('category_id', $home_categories)->get();
        $blade['categories'] = $categories;

        //Slider
        $poster_group = PosterGroup::where('status', 1)->find(config('theme.home_poster'));
        $blade['poster_group'] = $poster_group;

        //En Çok Satanlar
        $most_sales = config('theme.most_sales') ?? [];
        $products = Product::where('status', 1)->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        })
            ->whereIn('product_id', $most_sales)
            ->with('currentCampaign')
            ->orderBy('order', 'ASC')
            ->get();
        $blade['most_products'] = $products;

        //Bankalar
        $page = Page::where('status', 1)->find(config('theme.home_bank'));
        if ($page && $page->children->where('status', 1)->count() > 0) {
            $blade['home_banks'] = $page->children->where('status', 1);
        } else {
            $blade['home_banks'] = [];
        }

        //Teslimat Bilgileri
        $page = Page::where('status', 1)->find(config('theme.home_delivered'));
        if ($page && $page->children->where('status', 1)->count() > 0) {
            $blade['home_deliveries'] = $page->children->where('status', 1);
        } else {
            $blade['home_deliveries'] = [];
        }

        //Haftanın Fırsatı
        $product = Product::where('status', 1)->with(['brand', 'categories', 'currentCampaign'])
            ->find(config('theme.week_product'));
        $blade['week_product'] = $product;

        //Astronomi Güncesi
        $page = Page::where('status', 1)
            ->with(['children' => function ($query) {
                $query->where('status', 1);
            }])
            ->find(config('theme.home_page_middle'));
        $blade['page_middle'] = $page;

        //Kampanyalı Ürünler
        $home_campaigns = config('theme.home_campaigns') ?? [];
        $products = Product::where('status', 1)->where(function ($query) {
            $query->where('date_available', null)
                ->orWhereDate('date_available', '>=', Carbon::now());
        })
            ->whereIn('product_id', $home_campaigns)
            ->with('currentCampaign')
            ->with('images')
            ->with('categories')
            ->orderBy('order', 'ASC')
            ->get();
        $blade['campaigns'] = $products;

        return view('frontend.home.index', $blade);
    }
}
