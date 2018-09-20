<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\BackendController;
use App\Model\Customers\CustomerGroup;
use App\Model\Pages\Page;
use App\Model\Posters\PosterGroup;
use App\Model\Products\Attribute;
use App\Model\Products\Brand;
use App\Model\Products\Category;
use App\Model\Products\Download;
use App\Model\Products\Filter;
use App\Model\Products\Product;
use App\Model\Products\Icon;
use Illuminate\Http\Request;

class SearchController extends BackendController
{
    public function brands(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');
        if (is_array($id)) {
            $brands = Brand::whereIn('brand_id', $id)->get();
        } else {
            $brands = Brand::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }

        $brands->map(function ($brand) {
            $brand['id'] = $brand->id();
            return $brand;
        });

        return response()->json($brands->toArray());
    }

    public function categories(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $categories = Category::whereIn('category_id', $id)->get();
        } else {
            $categories = Category::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $categories->map(function ($category) {

            $category['id'] = $category->id();
            $category_names = [];
            $category_names[] = $category->name;

            $parent = $category->parent;
            if ($parent) {
                while (true) {
                    $category_names[] = $parent->name;
                    if ($parent->parent) {
                        $parent = $parent->parent;
                    } else {
                        break;
                    }
                }
            }

            $category['name'] = implode(' > ', array_reverse($category_names));
            return $category;
        });

        return response()->json($categories->toArray());
    }

    public function customerGroups(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $customer_groups = CustomerGroup::whereIn('customer_group_id', $id)->get();
        } else {
            $customer_groups = CustomerGroup::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }

        $customer_groups->map(function ($customer_group) {
            $customer_group['id'] = $customer_group->id();
            return $customer_group;
        });

        return response()->json($customer_groups->toArray());
    }

    public function downloads(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $downloads = Download::whereIn('download_id', $id)->get();
        } else {
            $downloads = Download::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $downloads->map(function ($download) {
            $download['id'] = $download->id();
            return $download;
        });

        return response()->json($downloads->toArray());
    }

    public function icons(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $icons = Icon::whereIn('icon_id', $id)->get();
        } else {
            $icons = Icon::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $icons->map(function ($icon) {
            $icon['id'] = $icon->id();
            return $icon;
        });

        return response()->json($icons->toArray());
    }

    public function filters(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $filters = Filter::whereIn('filter_id', $id)->get();
        } else {
            $filters = Filter::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }

        $filters->map(function ($filter) {
            $filter['id'] = $filter->id();
            return $filter;
        });

        return response()->json($filters->toArray());
    }

    public function products(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $products = Product::whereIn('product_id', $id)->get();
        } else {
            $products = Product::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(25)
                ->get();
        }
        $products->map(function ($product) {
            $product['id'] = $product->id();
            return $product;
        });

        return response()->json($products->toArray());
    }

    public function attributes(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $attributes = Attribute::whereIn('attribute_id', $id)->get();
        } else {
            $attributes = Attribute::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $attributes->map(function ($attribute) {
            $attribute['id'] = $attribute->id();
            $attribute['name'] = $attribute->group->name . ' > ' . $attribute->name;
            return $attribute;
        });

        return response()->json($attributes->toArray());
    }

    public function posters(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $posters = PosterGroup::whereIn('poster_group_id', $id)->get();
        } else {
            $posters = PosterGroup::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $posters->map(function ($poster) {
            $poster['id'] = $poster->id();
            return $poster;
        });

        return response()->json($posters->toArray());
    }

    public function pages(Request $request)
    {
        $term = $request->input('term');
        $id = $request->input('id');

        if (is_array($id)) {
            $pages = Page::whereIn('page_id', $id)->get();
        } else {
            $pages = Page::where('name', 'LIKE', '%' . $term . '%')
                ->orderBy('name', 'ASC')
                ->limit(15)
                ->get();
        }
        $pages->map(function ($page) {

            $page['id'] = $page->id();
            $page_names = [];
            $page_names[] = $page->name;

            $parent = $page->parent;
            if ($parent) {
                while (true) {
                    $page_names[] = $parent->name;
                    if ($parent->parent) {
                        $parent = $parent->parent;
                    } else {
                        break;
                    }
                }
            }

            $page['name'] = implode(' > ', array_reverse($page_names));
            return $page;
        });

        return response()->json($pages->toArray());
    }
}
