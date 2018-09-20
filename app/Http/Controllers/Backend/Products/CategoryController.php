<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Category;
use App\Model\Products\CategoryAttribute;
use Illuminate\Http\Request;

class CategoryController extends BackendController
{
    public function lists($id)
    {
        $breadcrumbs = [];
        if ($id > 0) {
            $category = Category::with('parent')->orderBy('order', 'ASC')->findOrFail($id);
            $breadcrumbs = $category->backendBreadcrumbs();
        }
        view()->share('breadcrumbs', array_merge([
            ['name' => 'Kategoriler', 'link' => route('backend.product.category.lists', ['id' => 0])]
        ], $breadcrumbs));

        $blade = [];
        $blade['id'] = $id;
        $categories = Category::orderBy('order', 'ASC')->where('parent_id', $id)->paginate(config('default.paginate'));
        $blade['categories'] = $categories;
        return view('backend.products.category_lists', $blade);
    }

    public function add($id)
    {
        $breadcrumbs = [];
        if ($id > 0) {
            $category = Category::with('parent')->findOrFail($id);
            $breadcrumbs = $category->backendBreadcrumbs();
        }
        view()->share('breadcrumbs', array_merge([
            ['name' => 'Kategoriler', 'link' => route('backend.product.category.lists', ['id' => 0])]
        ], $breadcrumbs));

        $blade = [];
        $blade['id'] = $id;

        return view('backend.products.category_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'attribute_id' => 'array',
            'order' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
    }

    public function added($id, Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:categories,seo_name',
        ]);

        $save = [
            'status' => $request->post('status'),
            'parent_id' => $id,
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'image2' => $request->post('image2'),
            'image3' => $request->post('image3'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        $category = Category::create($save);

        if ($request->has('attribute_id')) {
            foreach ($request->post('attribute_id') as $attribute_id) {
                CategoryAttribute::create([
                    'category_id' => $category->id(),
                    'attribute_id' => $attribute_id
                ]);
            }
        }

        return redirect()->route('backend.product.category.lists', ['id' => $id])
            ->with('success', 'Kategori Eklendi');
    }

    public function edit($id)
    {
        $category = Category::with('parent')->findOrFail($id);
        view()->share('breadcrumbs', array_merge([
            ['name' => 'Kategoriler', 'link' => route('backend.product.category.lists', ['id' => 0])]
        ], $category->backendBreadcrumbs()));

        $blade['category'] = $category;

        return view('backend.products.category_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:categories,seo_name,' . $id . ',category_id',
        ]);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'image2' => $request->post('image2'),
            'image3' => $request->post('image3'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        Category::where('category_id', $id)->update($update);

        CategoryAttribute::where('category_id', $id)->delete();
        if ($request->has('attribute_id')) {
            foreach ($request->post('attribute_id') as $attribute_id) {
                CategoryAttribute::create([
                    'category_id' => $id,
                    'attribute_id' => $attribute_id
                ]);
            }
        }

        return redirect()->route('backend.product.category.lists', ['id' => $category->parent_id])
            ->with('success', 'Kategori Düzenlendi');
    }

    public function remove($id)
    {
        $category = Category::with('children')->findOrFail($id);
        if ($category->children->count() < 1) {
            Category::destroy($id);
            return redirect()->route('backend.product.category.lists', ['id' => $category->parent_id])
                ->with('success', 'Kategori Silindi');
        } else {
            return redirect()->route('backend.product.category.lists', ['id' => $category->parent_id])
                ->withErrors('Kategoriye ait alt kategoriler olduğu için kategori silinemedi');
        }
    }
}
