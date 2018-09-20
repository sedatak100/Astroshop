<?php

namespace App\Http\Controllers\Backend\Taxes;

use App\Http\Controllers\BackendController;
use App\Model\Customers\CustomerGroup;
use App\Model\Regions\Region;
use App\Model\Taxes\TaxRate;
use App\Model\Taxes\TaxRateCustomerGroup;
use Illuminate\Http\Request;

class TaxRateController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Oranları', 'link' => '']
        ]);

        $blade = [];
        $tax_rates = TaxRate::all();
        $blade['tax_rates'] = $tax_rates;
        return view('backend.taxes.tax_rate_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Oranları', 'link' => route('backend.tax.rate.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $customer_groups = CustomerGroup::all();
        $blade['customer_groups'] = $customer_groups;

        $regions = Region::all();
        $blade['regions'] = $regions;

        return view('backend.taxes.tax_rate_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'region_id' => 'required|numeric|min:1',
            'customer_group_ids' => 'required',
            'name' => 'required',
            'rate' => 'required|numeric',
            'type' => 'required|string',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'region_id' => $request->post('region_id'),
            'name' => $request->post('name'),
            'rate' => $request->post('rate'),
            'type' => $request->post('type')
        ];
        $tax_rate = TaxRate::create($save);

        if ($request->post('customer_group_ids')) {
            foreach ($request->post('customer_group_ids') as $customer_group_id) {
                TaxRateCustomerGroup::create([
                    'tax_rate_id' => $tax_rate->id(),
                    'customer_group_id' => $customer_group_id
                ]);
            }
        }

        return redirect()->route('backend.tax.rate.lists')
            ->with('success', 'Vergi Oranı Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Oranları', 'link' => route('backend.tax.rate.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $tax_rate = TaxRate::findOrFail($id);
        $blade['tax_rate'] = $tax_rate;

        $tax_rate_customer_groups = $tax_rate->customerGroups();
        $blade['selected_customer_groups'] = array_column($tax_rate_customer_groups->toArray(), 'customer_group_id');

        $customer_groups = CustomerGroup::all();
        $blade['customer_groups'] = $customer_groups;

        $regions = Region::all();
        $blade['regions'] = $regions;

        return view('backend.taxes.tax_rate_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'region_id' => $request->post('region_id'),
            'name' => $request->post('name'),
            'rate' => $request->post('rate'),
            'type' => $request->post('type')
        ];
        TaxRate::where('tax_rate_id', $id)->update($update);

        TaxRateCustomerGroup::where('tax_rate_id', $id)->delete();
        if ($request->post('customer_group_ids')) {
            foreach ($request->post('customer_group_ids') as $customer_group_id) {
                TaxRateCustomerGroup::create([
                    'tax_rate_id' => $id,
                    'customer_group_id' => $customer_group_id
                ]);
            }
        }

        return redirect()->route('backend.tax.rate.lists')
            ->with('success', 'Vergi Oranı Düzenlendi');
    }

    public function remove($id)
    {
        TaxRate::destroy($id);
        TaxRateCustomerGroup::where('tax_rate_id', $id)->delete();
        return redirect()->route('backend.tax.rate.lists')
            ->with('success', 'Vergi Oranı Silindi');
    }
}
