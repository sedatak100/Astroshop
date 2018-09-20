<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\FrontendController;
use App\Model\Pages\Page;
use App\Model\Products\Brand;
use App\Model\Products\Category;
use App\Model\Products\ProductTag;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function view($seo_name)
    {
        $blade = [];

        $page = Page::where([
            'status' => 1,
            'hidden' => 0,
            'seo_name' => $seo_name
        ])->firstOrFail();
        $blade['page'] = $page;

        view()->share('breadcrumbs', array_merge([
        ], $page->frontendBreadcrumbs()));

        $categories = Category::where([
            'status' => 1,
            'parent_id' => 0
        ])->get();
        $blade['categories'] = $categories;

        $brands = Brand::where('status', 1)->get();
        $blade['brands'] = $brands;

        $tags = ProductTag::limit(10)->get();
        $blade['tags'] = $tags;

        return view('frontend.pages.page_view', $blade);
    }
}
