<?php

namespace App\Http\Controllers\Backend\Statuses;

use App\Http\Controllers\BackendController;
use App\Model\Statuses\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Sipariş Durumları', 'link' => '']
        ]);

        $blade = [];
        $order_statuses = OrderStatus::all();
        $blade['order_statuses'] = $order_statuses;
        return view('backend.statuses.order_status_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Sipariş Durumları', 'link' => route('backend.status.order_status.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.statuses.order_status_add');
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
        OrderStatus::create($save);

        return redirect()->route('backend.status.order_status.lists')
            ->with('success', 'Sipariş Durumu Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Sipariş Durumları', 'link' => route('backend.status.order_status.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $order_status = OrderStatus::findOrFail($id);
        $blade['order_status'] = $order_status;

        return view('backend.statuses.order_status_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
        ];
        OrderStatus::where('order_status_id', $id)->update($update);

        return redirect()->route('backend.status.order_status.lists')
            ->with('success', 'Sipariş Durumu Düzenlendi');
    }

    public function remove($id)
    {
        OrderStatus::destroy($id);

        return redirect()->route('backend.status.order_status.lists')
            ->with('success', 'Sipariş Durumu Silindi');
    }
}
