<?php

namespace App\Http\Controllers\Backend\Statuses;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Statuses\StockStatus;
use Illuminate\Http\Request;

class StockStatusController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Stok Durumları', 'link' => '']
        ]);

        $blade = [];
        $stock_statuses = StockStatus::all();
        $blade['stock_statuses'] = $stock_statuses;
        return view('backend.statuses.stock_status_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Stok Durumları', 'link' => route('backend.status.stock_status.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.statuses.stock_status_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
        ];
        $stock_status = StockStatus::create($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'stock_status'
            ])->update([
                'value' => $stock_status->id()
            ]);
        }

        return redirect()->route('backend.status.stock_status.lists')
            ->with('success', 'Stok Durumu Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Stok Durumları', 'link' => route('backend.status.stock_status.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $stock_status = StockStatus::findOrFail($id);
        $blade['stock_status'] = $stock_status;

        return view('backend.statuses.stock_status_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
        ];
        StockStatus::where('stock_status_id', $id)->update($update);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'stock_status'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.status.stock_status.lists')
            ->with('success', 'Stok Durumu Düzenlendi');
    }

    public function remove($id)
    {
        StockStatus::destroy($id);

        return redirect()->route('backend.status.stock_status.lists')
            ->with('success', 'Stok Durumu Silindi');
    }
}
