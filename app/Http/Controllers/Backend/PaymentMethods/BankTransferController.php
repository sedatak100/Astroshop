<?php

namespace App\Http\Controllers\Backend\PaymentMethods;

use App\Model\Configs\Config;
use App\Model\Regions\Region;
use App\Model\Statuses\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankTransferController extends Controller
{
    private function formValidate(Request $request)
    {
        $request->validate([
            'payment.info' => 'required',
            'payment.order_status' => 'required|integer',
            'payment.total' => 'required|numeric',
            //'payment.region_scope_id' => 'required|integer',
            'payment.status' => 'required|integer',
            'payment.order' => 'required|integer'
        ]);
    }

    public function edit()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ödeme Methodları', 'link' => ''],
            ['name' => 'Banka Havale / Eft', 'link' => ''],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $order_statuses = OrderStatus::all();
        $blade['order_statuses'] = $order_statuses;

        $regions = Region::all();
        $blade['regions'] = $regions;

        return view('backend.payment_methods.bank_transfer', $blade);
    }

    public function edited(Request $request)
    {
        $this->formValidate($request);

        foreach ($request->post('payment') as $key => $value) {
            $data = [
                'group' => 'payment_bank_transfer',
                'key' => $key,
                'value' => $value,
                'serialized' => 0
            ];
            Config::updateOrCreate([
                'group' => 'payment_bank_transfer',
                'key' => $key
            ], $data);
        }

        Config::updateOrCreate([
            'group' => 'payment_bank_transfer',
            'key' => 'model'
        ], [
            'group' => 'payment_bank_transfer',
            'key' => 'model',
            'value' => 'App\Model\PaymentMethods\BankTransfer',
            'serialized' => 0
        ]);

        return redirect()->route('backend.payment_method.bank_transfer.edit')
            ->with('success', 'Ödeme Metodu Düzenlendi');
    }
}
