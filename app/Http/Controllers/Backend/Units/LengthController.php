<?php

namespace App\Http\Controllers\Backend\Units;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Units\Length;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LengthController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Uzunluk Birimleri', 'link' => '']
        ]);

        $blade = [];
        $lengths = Length::all();
        $blade['lengths'] = $lengths;
        return view('backend.units.length_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Uzunluk Birimleri', 'link' => route('backend.unit.length.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.units.length_add');
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
        $length = Length::create($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'length'
            ])->update([
                'value' => $length->id()
            ]);
        }

        return redirect()->route('backend.unit.length.lists')
            ->with('success', 'Uzunluk Birimi Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Uzunluk Birimleri', 'link' => route('backend.unit.length.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $length = Length::findOrFail($id);
        $blade['length'] = $length;

        return view('backend.units.length_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
            'unit' => $request->post('unit'),
            'value' => $request->post('value')
        ];
        Length::where('length_id')->update($update);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'length'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.unit.length.lists')
            ->with('success', 'Uzunluk Birimi Düzenlendi');
    }

    public function remove($id)
    {
        Length::destroy($id);

        return redirect()->route('backend.unit.length.lists')
            ->with('success', 'Uzunluk Birimi Silindi');
    }
}
