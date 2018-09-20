<?php

namespace App\Http\Controllers\Backend\Currencies;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Currencies\Currency;
use App\Model\Currencies\CurrencyHistory;
use App\Model\Currencies\Tcmb;
use Illuminate\Http\Request;

class CurrencyController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Para Birimi', 'link' => '']
        ]);

        $blade = [];
        $currencies = Currency::all();
        $blade['currencies'] = $currencies;
        return view('backend.currencies.currency_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Para Birimi', 'link' => route('backend.currency.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.currencies.currency_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'decimal_place' => 'required',
            'value' => 'required',
            'default' => 'required'
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'decimal_place' => $request->post('decimal_place'),
            'symbol_left' => $request->post('symbol_left'),
            'symbol_right' => $request->post('symbol_right'),
            'value' => $request->post('value')
        ];
        $currency = Currency::create($save);

        CurrencyHistory::create([
            'currency_id' => $currency->id(),
            'code' => $currency->code,
            'value' => $request->post('value'),
            'old_value' => $currency->value,
            'key' => 'backend_add',
            'description' => 'Currency Create Customer'
        ]);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'currency'
            ])->update([
                'value' => $currency->id()
            ]);
        }

        return redirect()->route('backend.currency.lists')
            ->with('success', 'Para Birimi Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Para Birimi', 'link' => route('backend.currency.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $currency = Currency::with(['histories' => function ($query) {
            $query->orderBy('created_at', 'DESC');
            $query->limit(9);
        }])->findOrFail($id);
        $blade['currency'] = $currency;

        return view('backend.currencies.currency_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $currency = Currency::findOrFail($id);

        $update = [
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'decimal_place' => $request->post('decimal_place'),
            'symbol_left' => $request->post('symbol_left'),
            'symbol_right' => $request->post('symbol_right'),
            'value' => $request->post('value')
        ];
        Currency::where('currency_id', $id)->update($update);

        CurrencyHistory::create([
            'currency_id' => $currency->id(),
            'code' => $currency->code,
            'value' => $request->post('value'),
            'old_value' => $currency->value,
            'key' => 'backend_edit',
            'description' => 'Currency Update Customer'
        ]);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'currency'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.currency.lists')
            ->with('success', 'Para Birimi Düzenlendi');
    }

    public function update()
    {
        $tcmb = new Tcmb();
        $tcmb->run();
        return redirect()->route('backend.currency.lists')
            ->with('success', 'Para Birimleri Güncellendi');
    }

    public function remove($id)
    {
        Currency::destroy($id);

        return redirect()->route('backend.currency.lists')
            ->with('success', 'Para Birimi Silindi');
    }
}
