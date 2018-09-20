<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Icon;
use Illuminate\Http\Request;

class IconController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Iconlar', 'link' => '']
        ]);

        $blade = [];
        $icons = Icon::paginate(config('backend.paginate'));
        $blade['icons'] = $icons;
        return view('backend.products.icon_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Iconlar', 'link' => route('backend.product.icon.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.products.icon_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'icon' => $request->post('icon'),
            'image' => $request->post('image')
        ];
        Icon::create($save);

        return redirect()->route('backend.product.icon.lists')
            ->with('success', 'Icon Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Iconlar', 'link' => route('backend.product.icon.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $icon = Icon::findOrFail($id);
        $blade['icon'] = $icon;

        return view('backend.products.icon_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'icon' => $request->post('icon'),
            'image' => $request->post('image')
        ];
        Icon::where('icon_id', $id)->update($update);

        return redirect()->route('backend.product.icon.lists')
            ->with('success', 'Ikon Düzenlendi');
    }

    public function remove($id)
    {
        Icon::destroy($id);

        return redirect()->route('backend.product.icon.lists')
            ->with('success', 'Icon Silindi');
    }
}
