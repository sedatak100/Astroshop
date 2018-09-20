<?php

namespace App\Http\Controllers\Backend\Api;

use App\Model\Regions\City;
use App\Model\Regions\Country;
use App\Http\Controllers\BackendController;
use App\Model\Regions\District;
use Illuminate\Http\Request;

class RegionController extends BackendController
{
    public function countries(Request $request)
    {
        $term = $request->input('term');
        $countries = Country::where('name', 'LIKE', '%' . $term . '%')->get();
        $_countries = [];
        foreach ($countries as $country) {
            $_country = [];
            $_country['id'] = $country->id();
            $_country['name'] = $country->name .
                ($country->status == 0) ?? '(' . __('backend/common.status_' . $country->status) . ')';
            array_push($_countries, $_country);
        }
        return response()->json($_countries);
    }

    public function citiesByCountry(Request $request)
    {
        $country_id = $request->get('country_id');
        $country = Country::findOrFail($country_id);
        $term = $request->input('term');
        if ($term != '') {
            $cities = City::where('country_id', $country->id())
                ->where('name', 'LIKE', '%' . $term . '%')->get();
        } else {
            $cities = $country->cities();
        }
        $_cities = $cities->map(function ($city) {
            return [
                'id' => $city->id(),
                'name' => $city->name .
                    ($city->status == 0) ?? '(' . __('backend/common.status_' . $city->status) . ')',
                'code' => $city->code,
                'order' => $city->order,
                'created_at' => $city->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $city->updated_at->format('Y-m-d H:i:s'),
            ];
        })->toArray();

        $data = [
            'id' => $country_id,
            'status' => $country->status,
            'name' => $country->name .
                ($country->status == 0) ?? '(' . __('backend/common.status_' . $country->status) . ')',
            'code' => $country->code,
            'order' => $country->order,
            'cities' => $_cities,
            'created_at' => $country->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $country->updated_at->format('Y-m-d H:i:s'),
        ];
        return response()->json($data);
    }

    public function districtsByCity(Request $request)
    {
        $city_id = $request->get('city_id');
        $city = City::findOrFail($city_id);
        $term = $request->input('term');
        if ($term != '') {
            $districts = District::where('city_id', $city->id())
                ->where('name', 'LIKE', '%' . $term . '%')->get();
        } else {
            $districts = $city->districts();
        }
        $_districts = $districts->map(function ($district) {
            return [
                'id' => $district->id(),
                'name' => $district->name .
                    ($district->status == 0) ?? '(' . __('backend/common.status_' . $district->status) . ')',
                'code' => $district->code,
                'order' => $district->order,
                'created_at' => $district->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $district->updated_at->format('Y-m-d H:i:s'),
            ];
        })->toArray();

        $data = [
            'id' => $city_id,
            'status' => $city->status,
            'name' => $city->name .
                ($city->status == 0) ?? '(' . __('backend/common.status_' . $city->status) . ')',
            'code' => $city->code,
            'order' => $city->order,
            'districts' => $_districts,
            'created_at' => $city->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $city->updated_at->format('Y-m-d H:i:s'),
        ];
        return response()->json($data);
    }

    public function districtCityCountry(Request $request)
    {
        $data = [];
        $id = $request->input('id');
        $district = District::findOrFail($id);
        $city = $district->city();
        $country = $district->country();
        if ($city && $country) {
            $data = [
                'country' => [
                    'id' => $country->id(),
                    'name' => $country->name
                ],
                'city' => [
                    'id' => $city->id(),
                    'name' => $city->name
                ],
                'district' => [
                    'id' => $district->id(),
                    'name' => $district->name
                ]
            ];
        }
        return response()->json($data);
    }
}
