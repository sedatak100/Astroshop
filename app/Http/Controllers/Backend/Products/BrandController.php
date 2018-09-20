<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Brand;
use Illuminate\Http\Request;

class BrandController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Markalar', 'link' => '']
        ]);

        $blade = [];
        $brands = Brand::paginate(config('default.paginate'));
        $blade['brands'] = $brands;
        return view('backend.products.brand_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Markalar', 'link' => route('backend.product.brand.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.products.brand_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:brands,seo_name',
        ]);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        Brand::create($save);

        return redirect()->route('backend.product.brand.lists')
            ->with('success', 'Marka Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Markalar', 'link' => route('backend.product.brand.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $brand = Brand::findOrFail($id);
        $blade['brand'] = $brand;

        return view('backend.products.brand_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:brands,seo_name,' . $id . ',brand_id',
        ]);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        Brand::where('brand_id', $id)->update($save);

        return redirect()->route('backend.product.brand.lists')
            ->with('success', 'Marka Eklendi');
    }

    public function remove($id)
    {
        Brand::destroy($id);
        return redirect()->route('backend.product.brand.lists')
            ->with('success', 'Marka Silindi');
    }
}
