<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Filter;
use App\Model\Products\FilterGroup;
use Illuminate\Http\Request;

class FilterController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Filtreler', 'link' => '']
        ]);

        $blade = [];
        $filter_groups = FilterGroup::orderBy('order', 'ASC')->paginate(config('default.paginate'));
        $blade['filter_groups'] = $filter_groups;
        return view('backend.products.filter_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Filtreler', 'link' => route('backend.product.filter.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['types'] = FilterGroup::types();

        return view('backend.products.filter_add', $blade);
    }

    public function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|string',
            'order' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        if ($request->post('filter')) {
            foreach ($request->post('filter') as $i => $filter) {
                $request->validate([
                    'filter.' . $i . '.status' => 'required|numeric',
                    'filter.' . $i . '.name' => 'required',
                    'filter.' . $i . '.order' => 'required|numeric'
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
            'type' => $request->post('type'),
            'order' => $request->post('order')
        ];
        $filter_group = FilterGroup::create($save);


        foreach ($request->post('filter') as $i => $filter) {
            Filter::create([
                'status' => $filter['status'],
                'filter_group_id' => $filter_group->id(),
                'name' => $filter['name'],
                'order' => $filter['order'],
            ]);
        }

        return redirect()->route('backend.product.filter.lists')
            ->with('success', 'Filtre Eklendi');
    }

    public function edit($id, Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Filtreler', 'link' => route('backend.product.filter.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['types'] = FilterGroup::types();
        $filter_group = FilterGroup::findOrFail($id);
        $blade['filter_group'] = $filter_group;

        return response()->view('backend.products.filter_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'order' => $request->post('order')
        ];
        FilterGroup::where('filter_group_id', $id)->update($update);

        $no_delete_ids = [];
        foreach ($request->post('filter') as $i => $filter) {
            $save_filter = [
                'status' => $filter['status'],
                'filter_group_id' => $id,
                'name' => $filter['name'],
                'order' => $filter['order'],
            ];
            $filter = Filter::updateOrCreate(['filter_id' => $filter['filter_id']], $save_filter);
            $no_delete_ids[] = $filter->id();
        }
        Filter::where('filter_group_id', $id)->whereNotIn('filter_id', $no_delete_ids)->delete();

        return redirect()->route('backend.product.filter.lists')
            ->with('success', 'Filtre Düzenlendi');
    }

    public function remove($id)
    {
        // todo: silme işlemi yapılacak
        die('TODO: silme işlemi yapılacak');
        return redirect()->route('backend.product.filter.lists')
            ->with('success', 'Filtre Silindi');
    }
}
