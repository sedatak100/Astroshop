<?php

namespace App\Http\Controllers\Backend\Units;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Units\Weight;
use Illuminate\Http\Request;

class WeightController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ağırlık Birimleri', 'link' => '']
        ]);

        $blade = [];
        $weights = Weight::all();
        $blade['weights'] = $weights;
        return view('backend.units.weight_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ağırlık Birimleri', 'link' => route('backend.unit.weight.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.units.weight_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'value' => 'required|numeric',
            'default' => 'required'
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'unit' => $request->post('unit'),
            'value' => $request->post('value')
        ];
        $weight = Weight::create($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'weight'
            ])->update([
                'value' => $weight->id()
            ]);
        }

        return redirect()->route('backend.unit.weight.lists')
            ->with('success', 'Ağırlık Birimi Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ağırlık Birimleri', 'link' => route('backend.unit.weight.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $weight = Weight::findOrFail($id);
        $blade['weight'] = $weight;

        return view('backend.units.weight_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
            'unit' => $request->post('unit'),
            'value' => $request->post('value')
        ];
        Weight::where('weight_id')->update($update);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'weight'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.unit.weight.lists')
            ->with('success', 'Ağırlık Birimi Düzenlendi');
    }

    public function remove($id)
    {
        Weight::destroy($id);

        return redirect()->route('backend.unit.weight.lists')
            ->with('success', 'Ağırlık Birimi Silindi');
    }
}
