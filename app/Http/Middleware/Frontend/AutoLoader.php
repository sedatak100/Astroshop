<?php

namespace App\Http\Middleware\Frontend;

use App\Model\Pages\Page;
use App\Model\Products\Category;
use Closure;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class AutoLoader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->topCategories();
        $this->footerPages();
        return $next($request);
    }

    public function topCategories()
    {
        $top_categories = config('theme.top_categories') ?? [];
        $categories = Category::where('status', 1)->whereIn('category_id', $top_categories)->get();
        \View::share('top_categories', $categories);
    }

    public function footerPages()
    {
        $footer_pages = config('theme.footer_pages') ?? [];
        $pages = Page::where('status', 1)->whereIn('page_id', $footer_pages)->get();
        \View::share('footer_pages', $pages);
    }
}
