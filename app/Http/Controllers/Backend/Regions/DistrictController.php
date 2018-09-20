<?php

namespace App\Http\Controllers\Backend\Regions;

use App\Http\Controllers\BackendController;
use App\Model\Regions\City;
use App\Model\Regions\Country;
use App\Model\Regions\District;
use Illuminate\Http\Request;

class DistrictController extends BackendController
{
    public function lists($city_id)
    {
        $city = City::findOrFail($city_id);
        $country = Country::findOrFail($city->country_id);

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => $country->name, 'link' => route('backend.region.country.lists')],
            ['name' => $city->name, 'link' => route('backend.region.city.lists', ['country_id' => $country->id()])]
        ]);

        $blade = [];
        $districts = District::where('city_id', $city->id())
            ->orderBy('order', 'ASC')
            ->paginate(config('backend.paginate'));

        $blade['districts'] = $districts;
        $blade['city'] = $city;
        return view('backend.regions.district_lists', $blade);
    }

    public function add($city_id)
    {
        $city = City::findOrFail($city_id);
        $country = Country::findOrFail($city->country_id);

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => $country->name, 'link' => route('backend.region.country.lists')],
            ['name' => $city->name, 'link' => route('backend.region.city.lists', ['country_id' => $country->id()])],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['city'] = $city;

        return view('backend.regions.district_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'name' => 'required',
            'order' => 'integer'
        ]);
    }

    public function added($city_id, Request $request)
    {
        $city = City::findOrFail($city_id);

        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'country_id' => $city->country_id,
            'city_id' => $city->id(),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order')
        ];
        District::create($save);

        return redirect()->route('backend.region.district.lists', ['city_id' => $city->id()])
            ->with('success', 'İlçe Eklendi');
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);
        $city = $district->city();
        $country = $district->country();

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => $country->name, 'link' => route('backend.region.country.lists')],
            ['name' => $city->name, 'link' => route('backend.region.city.lists', ['country_id' => $country->id()])],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];

        $blade['district'] = $district;

        return view('backend.regions.district_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $district = District::findOrFail($id);

        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'country_id' => $district->country_id,
            'city_id' => $district->city_id,
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order')
        ];
        District::where('district_id', $id)->update($save);

        return redirect()->route('backend.region.district.lists', ['city_id' => $district->city_id])
            ->with('success', 'İlçe Düzenlendi');
    }

    public function remove($id)
    {
        $district = District::findOrFail($id);

        District::destroy($id);
        return redirect()->route('backend.region.district.lists', ['city_id' => $district->city_id])
            ->with('success', 'İlçe Silindi');
    }
}
