<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Attribute;
use App\Model\Products\AttributeGroup;
use Illuminate\Http\Request;

class AttributeController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Özellikler', 'link' => '']
        ]);

        $blade = [];
        $attribute_groups = AttributeGroup::orderBy('order', 'ASC')->paginate(config('default.paginate'));
        $blade['attribute_groups'] = $attribute_groups;
        return view('backend.products.attribute_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Özellikler', 'link' => route('backend.product.attribute.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.products.attribute_add');
    }

    public function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        if ($request->post('attribute')) {
            foreach ($request->post('attribute') as $i => $attribute) {
                $request->validate([
                    'attribute.' . $i . '.status' => 'required|numeric',
                    'attribute.' . $i . '.name' => 'required',
                    'attribute.' . $i . '.type' => 'required',
                    'attribute.' . $i . '.order' => 'required|numeric'
                ]);
            }
        }
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'order' => $request->post('order')
        ];
        $attribute_group = AttributeGroup::create($save);


        foreach ($request->post('attribute') as $i => $attribute) {
            Attribute::create([
                'status' => $attribute['status'],
                'attribute_group_id' => $attribute_group->id(),
                'name' => $attribute['name'],
                'type' => $attribute['type'],
                'order' => $attribute['order'],
            ]);
        }

        return redirect()->route('backend.product.attribute.lists')
            ->with('success', 'Özellik Eklendi');
    }

    public function edit($id, Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Özellikler', 'link' => route('backend.product.attribute.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $attribute_group = AttributeGroup::findOrFail($id);
        $blade['attribute_group'] = $attribute_group;

        return response()->view('backend.products.attribute_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'order' => $request->post('order')
        ];
        AttributeGroup::where('attribute_group_id', $id)->update($update);

        $no_delete_ids = [];
        foreach ($request->post('attribute') as $i => $attribute) {
            $save_attribute = [
                'status' => $attribute['status'],
                'attribute_group_id' => $id,
                'name' => $attribute['name'],
                'type' => $attribute['type'],
                'order' => $attribute['order'],
            ];
            $attribute = Attribute::updateOrCreate(['attribute_id' => $attribute['attribute_id']], $save_attribute);
            $no_delete_ids[] = $attribute->id();
        }
        Attribute::where('attribute_group_id', $id)->whereNotIn('attribute_id', $no_delete_ids)->delete();

        return redirect()->route('backend.product.attribute.lists')
            ->with('success', 'Özellik Düzenlendi');
    }

    public function remove($id)
    {
        // todo: silme işlemi yapılacak
        die('TODO: silme işlemi yapılacak');
        return redirect()->route('backend.product.attribute.lists')
            ->with('success', 'Özellik Silindi');
    }
}
