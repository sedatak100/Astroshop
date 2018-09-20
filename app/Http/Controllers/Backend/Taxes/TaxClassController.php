<?php

namespace App\Http\Controllers\Backend\Taxes;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Taxes\TaxClass;
use App\Model\Taxes\TaxRate;
use App\Model\Taxes\TaxRule;
use Illuminate\Http\Request;

class TaxClassController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Sınıfları', 'link' => ''],
        ]);

        $blade = [];
        $tax_classes = TaxClass::all();
        $blade['tax_classes'] = $tax_classes;
        return view('backend.taxes.tax_class_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Sınıfları', 'link' => route('backend.tax.class.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $tax_rates = TaxRate::all();
        $blade['tax_rates'] = $tax_rates;

        return view('backend.taxes.tax_class_add', $blade);
    }

    public function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'default' => 'required'
        ]);

        if ($request->post('rule')) {
            foreach ($request->post('rule') as $i => $rate) {
                $request->validate([
                    'rule.' . $i . '.tax_rate_id' => 'required|numeric',
                    'rule.' . $i . '.based' => 'required',
                    'rule.' . $i . '.priority' => 'required|numeric'
                ]);
            }
        }
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];

        $tax_class = TaxClass::create($save);

        foreach ($request->post('rule') as $i => $rate) {
            TaxRule::create([
                'tax_class_id' => $tax_class->id(),
                'tax_rate_id' => $rate['tax_rate_id'],
                'based' => $rate['based'],
                'priority' => $rate['priority']
            ]);
        }

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'tax_class'
            ])->update([
                'value' => $tax_class->id()
            ]);
        }

        return redirect()->route('backend.tax.class.lists')
            ->with('success', 'Vergi Sınıfı Eklendi');
    }

    public function edit($id, Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Vergi Sınıfları', 'link' => route('backend.tax.class.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $tax_class = TaxClass::findOrFail($id);
        $blade['tax_class'] = $tax_class;

        $tax_rates = TaxRate::all();
        $blade['tax_rates'] = $tax_rates;

        return view('backend.taxes.tax_class_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];

        $tax_class = TaxClass::where('tax_class_id', $id)->update($update);

        TaxRule::where('tax_class_id', $id)->delete();
        foreach ($request->post('rule') as $i => $rate) {
            TaxRule::create([
                'tax_class_id' => $id,
                'tax_rate_id' => $rate['tax_rate_id'],
                'based' => $rate['based'],
                'priority' => $rate['priority']
            ]);
        }

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'tax_class'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.tax.class.lists')
            ->with('success', 'Vergi Sınıfı Düzenlendi');
    }

    public function remove($id)
    {
        TaxClass::destroy($id);
        TaxRule::where('tax_class_id', $id)->delete();
        return redirect()->route('backend.tax.class.lists')
            ->with('success', 'Vergi Sınıfı Silindi');
    }
}
