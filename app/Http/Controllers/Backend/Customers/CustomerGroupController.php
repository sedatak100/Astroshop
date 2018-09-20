<?php

namespace App\Http\Controllers\Backend\Customers;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Customers\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteri Grupları', 'link' => '']
        ]);

        $blade = [];
        $customer_groups = CustomerGroup::orderBy('order', 'ASC')->paginate(config('backend.paginate'));
        $blade['customer_groups'] = $customer_groups;
        return view('backend.customers.customer_group_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteri Grupları', 'link' => route('backend.customer.group.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.customers.customer_group_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:10',
            'order' => 'required|numeric',
            'approval' => 'required|integer',
            'default' => 'required'
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'approval' => $request->post('approval'),
            'order' => $request->post('order')
        ];
        $customer_group = CustomerGroup::create($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'customer_group'
            ])->update([
                'value' => $customer_group->id()
            ]);
        }

        return redirect()->route('backend.customer.group.lists')
            ->with('success', 'Müşteri Grubu Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteri Grupları', 'link' => route('backend.customer.group.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $customer_group = CustomerGroup::findOrFail($id);
        $blade['customer_group'] = $customer_group;

        return view('backend.customers.customer_group_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'approval' => $request->post('approval'),
            'order' => $request->post('order')
        ];
        CustomerGroup::where('customer_group_id', $id)->update($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'customer_group'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.customer.group.lists')
            ->with('success', 'Müşteri Grubu Düzenlendi');
    }

    public function remove($id)
    {
        CustomerGroup::destroy($id);

        return redirect()->route('backend.customer.group.lists')
            ->with('success', 'Müşteri Grubu Silindi');
    }
}
