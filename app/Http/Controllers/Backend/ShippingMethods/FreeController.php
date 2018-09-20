<?php

namespace App\Http\Controllers\Backend\ShippingMethods;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Regions\Region;
use Illuminate\Http\Request;

class FreeController extends BackendController
{
    private function formValidate(Request $request)
    {
        $request->validate([
            'shipping.total' => 'required|numeric',
            //'shipping.region_scope_id' => 'required|integer',
            'shipping.status' => 'required|integer',
            'shipping.order' => 'required|integer'
        ]);
    }

    public function edit()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kargo Methodları', 'link' => ''],
            ['name' => 'Ücretsiz Kargo', 'link' => ''],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $regions = Region::all();
        $blade['regions'] = $regions;

        return view('backend.shipping_methods.free', $blade);
    }

    public function edited(Request $request)
    {
        $this->formValidate($request);

        foreach ($request->post('shipping') as $key => $value) {
            $data = [
                'group' => 'shipping_free',
                'key' => $key,
                'value' => $value,
                'serialized' => 0
            ];
            Config::updateOrCreate([
                'group' => 'shipping_free',
                'key' => $key
            ], $data);
        }

        Config::updateOrCreate([
            'group' => 'shipping_free',
            'key' => 'model'
        ], [
            'group' => 'shipping_free',
            'key' => 'model',
            'value' => 'App\Model\ShippingMethods\Free',
            'serialized' => 0
        ]);

        return redirect()->route('backend.shipping_method.free.edit')
            ->with('success', 'Kargo Metodu Düzenlendi');
    }
}
