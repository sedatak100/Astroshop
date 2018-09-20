<?php

namespace App\Http\Controllers\Frontend\Accounts;

use App\Model\Customers\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function edited(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        if ($request->post('type') == 'shipping') {
            $type = 'shipping';
        } else {
            $type = 'payment';
        }

        $request->validate([
            $type . '.firstname' => 'required|string',
            $type . '.lastname' => 'required|string',
            $type . '.country_id' => 'required|integer',
            $type . '.city_id' => 'required|integer',
            $type . '.district_id' => 'required|integer',
            $type . '.address1' => 'required',
            $type . '.postcode' => 'nullable|numeric'
        ]);

        $save = [
            'customer_id' => auth()->id(),
            'firstname' => $request->input($type . '.firstname'),
            'lastname' => $request->input($type . '.lastname'),
            'country_id' => $request->input($type . '.country_id'),
            'city_id' => $request->input($type . '.city_id'),
            'district_id' => $request->input($type . '.district_id'),
            'title' => $request->input('type'),
            'address1' => $request->input($type . '.address1'),
            'address2' => $request->input($type . '.address2'),
            'postcode' => $request->input($type . '.postcode')
        ];
        Address::updateOrCreate([
            'customer_id' => auth()->id(),
            'title' => $request->input('type')
        ], $save);

        return redirect()->route('frontend.account.view')
            ->with('success', 'Profil Bilgileri Güncellendi');
    }
}
