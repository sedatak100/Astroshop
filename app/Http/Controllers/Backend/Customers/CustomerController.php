<?php

namespace App\Http\Controllers\Backend\Customers;

use App\Http\Controllers\BackendController;
use App\Model\Customers\Address;
use App\Model\Customers\Customer;
use App\Model\Customers\CustomerGroup;
use App\Model\Regions\Country;
use App\Model\Regions\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteriler', 'link' => '']
        ]);

        $blade = [];
        $customers = Customer::orderBy('customer_id', 'DESC')
            ->paginate(config('backend.paginate'));
        $blade['customers'] = $customers;
        return view('backend.customers.customer_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteriler', 'link' => route('backend.customer.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $customer_groups = CustomerGroup::all(['customer_group_id', 'name']);
        $blade['customer_groups'] = $customer_groups;

        $countries = Country::where('status', 1)->get(['country_id', 'name']);
        $blade['countries'] = $countries;

        return view('backend.customers.customer_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'status' => 'required|numeric',
            'customer_group_id' => 'required|numeric',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'numeric|nullable',
            'gsm' => 'numeric|nullable',
            'fax' => 'numeric|nullable'
        ]);
    }

    private function formAddressValidate(Request $request)
    {
        $request->validate([
            'default' => 'numeric',
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'country_id' => 'required|integer',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer|min:1',
            'address1' => 'required|min:15',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);
        $request->validate([
            'email' => 'unique:customers,email',
            'password' => 'required|min:6',
        ]);

        $save = [
            'status' => $request->post('status'),
            'customer_group_id' => $request->post('customer_group_id'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'phone' => $request->post('phone'),
            'gsm' => $request->post('gsm'),
            'fax' => $request->post('fax')
        ];

        $customer = Customer::create($save);

        return redirect()->route('backend.customer.edit', ['id' => $customer->id()])
            ->with('success', 'Müşteri Eklendi');
    }

    public function addressAdded($customer_id, Request $request)
    {
        $this->formAddressValidate($request);

        $district = District::findOrFail($request->post('district_id'));

        $save = [
            'customer_id' => $customer_id,
            'country_id' => $district->country_id,
            'city_id' => $district->city_id,
            'district_id' => $district->id(),
            'title' => $request->post('title'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'company' => $request->post('company'),
            'address1' => $request->post('address1'),
            'address2' => $request->post('address2'),
            'postcode' => $request->post('postcode'),
        ];

        $address = Address::create($save);

        if ($request->post('default') == 1) {
            Customer::where('customer_id', $customer_id)->update(['address_id' => $address->id()]);
        }

        return redirect()->route('backend.customer.edit', ['id' => $customer_id, 'edit_address_id' => $address->id()])
            ->with('success', 'Yeni Adres Eklendi');
    }

    public function addressEdited($id, Request $request)
    {

        $address = Address::findOrFail($id);

        $this->formAddressValidate($request);

        $district = District::findOrFail($request->post('district_id'));

        $update = [
            'country_id' => $district->country_id,
            'city_id' => $district->city_id,
            'district_id' => $district->id(),
            'title' => $request->post('title'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'company' => $request->post('company'),
            'address1' => $request->post('address1'),
            'address2' => $request->post('address2'),
            'postcode' => $request->post('postcode'),
        ];

        Address::where('address_id', $id)->update($update);
        if ($request->post('default') == 1) {
            Customer::where('customer_id', $address->customer_id)->update(['address_id' => $id]);
        }

        return redirect()->route('backend.customer.edit', ['id' => $address->customer_id, 'edit_address_id' => $id])
            ->with('success', 'Adres Düzenlendi');
    }

    public function addressRemove($id)
    {
        $address = Address::findOrFail($id);
        Address::destroy($address->id());

        return redirect()->route('backend.customer.edit', ['id' => $address->customer_id, 'new_address' => true])
            ->with('success', 'Adres Silindi');
    }

    public function edit($id, Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Müşteriler', 'link' => route('backend.customer.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $customer = Customer::findOrFail($id);

        $blade['customer'] = $customer;
        $customer_groups = CustomerGroup::all(['customer_group_id', 'name']);
        $blade['customer_groups'] = $customer_groups;

        $blade['is_edit_address'] = false;
        if ($request->has('edit_address_id')) {
            $blade['is_edit_address'] = true;
            $blade['edit_address'] = Address::where([
                'customer_id' => $id,
                'address_id' => $request->get('edit_address_id')
            ])->first();
            if (!$blade['edit_address']) {
                return redirect()->route('backend.customer.edit', ['id' => $customer->id()])
                    ->withErrors('Müşteriye ait adres bulunamadı');
            }
        }

        $blade['is_new_address'] = false;
        if ($request->has('new_address')) {
            $blade['is_new_address'] = true;
        }

        return view('backend.customers.customer_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);
        $request->validate([
            'email' => 'unique:customers,email,' . $id . ',customer_id',
        ]);

        if ($request->post('password') != '') {
            $request->validate([
                'password' => 'required|min:6',
            ]);
        }

        $update = [
            'status' => $request->post('status'),
            'customer_group_id' => $request->post('customer_group_id'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'gsm' => $request->post('gsm'),
            'fax' => $request->post('fax')
        ];

        if ($request->post('password') != '') {
            $save['password'] = Hash::make($request->post('password'));
        }

        Customer::where('customer_id', $id)->update($update);

        return redirect()->route('backend.customer.edit', ['id' => $id])
            ->with('success', 'Müşteri Düzenlendi');
    }

    public function remove($id)
    {
        Customer::destroy($id);
        Address::where('customer_id', $id)->delete();

        return redirect()->route('backend.customer.lists')
            ->with('success', 'Müşteri Silindi');
    }
}