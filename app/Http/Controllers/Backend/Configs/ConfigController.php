<?php

namespace App\Http\Controllers\Backend\Configs;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Statuses\OrderStatus;
use Illuminate\Http\Request;

class ConfigController extends BackendController
{
    public function edit()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Genel Ayarlar', 'link' => ''],
        ]);

        $blade = [];

        $order_status = OrderStatus::all();
        $blade['order_status'] = $order_status;

        return view('backend.configs.config_edit', $blade);
    }

    public function edited(Request $request)
    {
        if ($request->has('config')) {
            foreach ($request->post('config') as $group => $configs) {
                foreach ($configs as $key => $value) {
                    if (is_array($value)) {
                        Config::where([
                            'group' => $group,
                            'key' => $key
                        ])->update([
                            'value' => json_encode($value),
                            'serialized' => 1
                        ]);
                    } else {
                        Config::where([
                            'group' => $group,
                            'key' => $key
                        ])->update([
                            'value' => $value
                        ]);
                    }
                }
            }
        }

        return redirect()->route('backend.config.edit')
            ->with('success', 'Genel Ayarlar Düzenlendi');
    }
}
