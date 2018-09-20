<?php

namespace App\Http\Controllers\Frontend\Accounts;

use App\Model\Customers\Address;
use App\Model\Customers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function view()
    {
        $blade = [];

        view()->share('breadcrumbs', [
            ['name' => 'Profilim', 'link' => route('frontend.account.view')]
        ]);

        $shipping_address = Address::where('title', 'shipping')->first();
        $blade['shipping_address'] = $shipping_address;

        $payment_address = Address::where('title', 'payment')->first();
        $blade['payment_address'] = $payment_address;

        return view('frontend.accounts.account_view', $blade);
    }

    public function edited(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'phone' => 'nullable|numeric:max:25',
            'gsm' => 'nullable|numeric:max:25',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->post('password') != '') {
            $password = Hash::make($request->post('password'));
        } else {
            $password = auth()->user()->password;
        }

        $update = [
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'password' => $password,
            'phone' => $request->post('phone'),
            'gsm' => $request->post('gsm')
        ];
        Customer::where('customer_id', auth()->id())->update($update);

        return redirect()->route('frontend.account.view')
            ->with('success', 'Profil Bilgileri Güncellendi');
    }
}
