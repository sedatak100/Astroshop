<?php

namespace App\Http\Controllers\Backend\Coupons;

use App\Http\Controllers\BackendController;
use App\Model\Coupons\Coupon;
use App\Model\Coupons\CouponCategory;
use App\Model\Coupons\CouponProduct;
use Illuminate\Http\Request;

class CouponController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kuponlar', 'link' => '']
        ]);

        $blade = [];
        $coupons = Coupon::orderBy('created_at', 'DESC')->paginate(config('default.paginate'));
        $blade['coupons'] = $coupons;
        return view('backend.coupons.coupon_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kuponlar', 'link' => route('backend.coupon.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.coupons.coupon_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'discount' => 'required|numeric',
            'total' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'uses_total' => 'required|integer',
            'uses_customer' => 'required|integer',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'code' => 'unique:coupons,code',
        ]);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'type' => $request->post('type'),
            'discount' => $request->post('discount'),
            'total' => $request->post('total'),
            'start_date' => $request->post('start_date'),
            'end_date' => $request->post('end_date'),
            'uses_total' => $request->post('uses_total'),
            'uses_customer' => $request->post('uses_customer'),
        ];
        $coupon = Coupon::create($save);

        if ($request->has('category_id')) {
            foreach ($request->post('category_id') as $category_id) {
                CouponCategory::create([
                    'coupon_id' => $coupon->id(),
                    'category_id' => $category_id
                ]);
            }
        }

        if ($request->has('product_id')) {
            foreach ($request->post('product_id') as $product_id) {
                CouponProduct::create([
                    'coupon_id' => $coupon->id(),
                    'product_id' => $product_id
                ]);
            };
        }

        return redirect()->route('backend.coupon.lists')
            ->with('success', 'Kupon Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kuponlar', 'link' => route('backend.coupon.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $coupon = Coupon::findOrFail($id);
        $blade['coupon'] = $coupon;

        return view('backend.coupons.coupon_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'code' => 'unique:coupons,code,' . $id . ',coupon_id',
        ]);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'type' => $request->post('type'),
            'discount' => $request->post('discount'),
            'total' => $request->post('total'),
            'start_date' => $request->post('start_date'),
            'end_date' => $request->post('end_date'),
            'uses_total' => $request->post('uses_total'),
            'uses_customer' => $request->post('uses_customer'),
        ];
        Coupon::where('coupon_id', $id)->update($update);

        CouponCategory::where('coupon_id', $id)->delete();
        if ($request->has('category_id')) {
            foreach ($request->post('category_id') as $category_id) {
                CouponCategory::create([
                    'coupon_id' => $id,
                    'category_id' => $category_id
                ]);
            }
        }

        CouponProduct::where('coupon_id', $id)->delete();
        if ($request->has('product_id')) {
            foreach ($request->post('product_id') as $product_id) {
                CouponProduct::create([
                    'coupon_id' => $id,
                    'product_id' => $product_id
                ]);
            };
        }

        return redirect()->route('backend.coupon.lists')
            ->with('success', 'Kupon Düzenlendi');
    }

    public function remove($id)
    {
        Coupon::destroy($id);
        CouponCategory::where('coupon_id', $id)->delete();
        CouponProduct::where('coupon_id', $id)->delete();
        return redirect()->route('backend.coupon.lists')
            ->with('success', 'Kupon Silindi');
    }
}
