<?php

namespace App\Http\Controllers\Backend\Regions;

use App\Http\Controllers\BackendController;
use App\Model\Regions\Country;
use App\Model\Regions\Region;
use App\Model\Regions\RegionScope;
use Illuminate\Http\Request;

class RegionController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Kapsamları', 'link' => '']
        ]);

        $blade = [];
        $regions = Region::all();
        $blade['regions'] = $regions;
        return view('backend.regions.region_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Kapsamları', 'link' => route('backend.region.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $countries = Country::all();
        $blade['countries'] = $countries;
        return view('backend.regions.region_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:10',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $country_ids = is_array($request->post('country_ids')) ? $request->post('country_ids') : [];
        $city_ids = is_array($request->post('city_ids')) ? $request->post('city_ids') : [];

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];
        $region = Region::create($save);

        foreach ($country_ids as $i => $country_id) {
            if (isset($city_ids[$i])) {
                $city_id = $city_ids[$i];
                RegionScope::create([
                    'region_id' => $region->id(),
                    'country_id' => $country_id,
                    'city_id' => $city_id
                ]);
            }
        }

        return redirect()->route('backend.region.lists')
            ->with('success', 'Bölge Kapsamı Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Kapsamları', 'link' => route('backend.region.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $countries = Country::all();
        $blade['countries'] = $countries;

        $region = Region::findOrFail($id);
        $blade['region'] = $region;

        // Selected Country And City
        $_country = [];
        $_city = [];
        $region_scopes = RegionScope::where('region_id', $region->id())->get();
        foreach ($region_scopes as $region_scope) {
            $_country[] = $region_scope->country_id;
            $_city[] = $region_scope->city_id;
        }
        $blade['selected_country'] = $_country;
        $blade['selected_city'] = $_city;

        return view('backend.regions.region_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $country_ids = is_array($request->post('country_ids')) ? $request->post('country_ids') : [];
        $city_ids = is_array($request->post('city_ids')) ? $request->post('city_ids') : [];

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];
        Region::where('region_id', $id)->update($save);
        RegionScope::where('region_id', $id)->delete();
        foreach ($country_ids as $i => $country_id) {
            if (isset($city_ids[$i])) {
                $city_id = $city_ids[$i];
                RegionScope::create([
                    'region_id' => $id,
                    'country_id' => $country_id,
                    'city_id' => $city_id
                ]);
            }
        }

        return redirect()->route('backend.region.lists')
            ->with('success', 'Bölge Kapsamı Düzenlendi');
    }

    public function remove($id)
    {
        Region::destroy($id);
        RegionScope::where('region_id', $id)->delete();

        return redirect()->route('backend.region.lists')
            ->with('success', 'Bölge Kapsamı Silindi');
    }
}
