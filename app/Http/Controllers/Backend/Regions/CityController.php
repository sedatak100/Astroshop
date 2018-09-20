<?php

namespace App\Http\Controllers\Backend\Regions;

use App\Http\Controllers\BackendController;
use App\Model\Regions\City;
use App\Model\Regions\Country;
use App\Model\Regions\District;
use Illuminate\Http\Request;

class CityController extends BackendController
{
    public function lists($country_id)
    {
        $country = Country::findOrFail($country_id);

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => $country->name, 'link' => '']
        ]);

        $blade = [];
        $cities = City::where('country_id', $country->id())
            ->orderBy('order', 'ASC')
            ->paginate(config('backend.paginate'));

        $blade['cities'] = $cities;
        $blade['country'] = $country;
        return view('backend.regions.city_lists', $blade);
    }

    public function add($country_id)
    {
        $country = Country::findOrFail($country_id);

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => $country->name, 'link' => route('backend.region.country.lists', ['id' => $country->id()])],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['country'] = $country;

        return view('backend.regions.city_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'name' => 'required',
            'order' => 'integer'
        ]);
    }

    public function added($country_id, Request $request)
    {
        $country = Country::findOrFail($country_id);

        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'country_id' => $country->id(),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order')
        ];
        City::create($save);

        return redirect()->route('backend.region.city.lists', ['country_id' => $country->id()])
            ->with('success', 'Şehir Eklendi');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $country = $city->country();

        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            [
                'name' => $country->name,
                'link' => route('backend.region.city.lists', ['country_id' => $country->id()])
            ],
            [
                'name' => $city->name,
                'link' => route('backend.region.city.lists', ['country_id' => $country->id()])
            ],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];

        $blade['city'] = $city;

        return view('backend.regions.city_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $city = City::findOrFail($id);

        $this->formValidate($request);

        $update = [
            'status' => $request->post('status'),
            'country_id' => $city->country_id,
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order')
        ];
        City::where('city_id', $id)->update($update);

        return redirect()->route('backend.region.city.lists', ['country_id' => $city->country_id])
            ->with('success', 'Şehir Düzenlendi');
    }

    public function remove($id)
    {
        $city = City::findOrFail($id);
        $district = District::where('city_id', $id)->count();
        if ($district < 1) {
            City::destroy($id);
            return redirect()->route('backend.region.city.lists', ['country_id' => $city->country_id])
                ->with('success', 'Şehir Silindi');
        } else {
            return redirect()->route('backend.region.city.lists', ['country_id' => $city->country_id])
                ->withErrors('Şehire ait İlçe(ler) tanımlı olduğundan şehir silinemedi');
        }
    }
}
