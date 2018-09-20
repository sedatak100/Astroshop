<?php

namespace App\Http\Controllers\Backend\Regions;

use App\Http\Controllers\BackendController;
use App\Model\Configs\Config;
use App\Model\Regions\City;
use App\Model\Regions\Country;
use Illuminate\Http\Request;

class CountryController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => '']
        ]);

        $blade = [];
        $countries = Country::orderBy('order', 'ASC')->paginate(config('backend.paginate'));
        $blade['countries'] = $countries;
        return view('backend.regions.country_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.regions.country_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'name' => 'required',
            'order' => 'integer'
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order')
        ];
        $country = Country::create($save);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'default_country'
            ])->update([
                'value' => $country->id()
            ]);
        }

        return redirect()->route('backend.region.country.lists')
            ->with('success', 'Ülke Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Bölge Yönetimi', 'link' => route('backend.region.country.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $country = Country::findOrFail($id);
        $blade['country'] = $country;

        return view('backend.regions.country_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'order' => $request->post('order'),
        ];
        Country::where('country_id', $id)->update($update);

        if ($request->post('default') == 1) {
            Config::where([
                'group' => 'config',
                'key' => 'default_country'
            ])->update([
                'value' => $id
            ]);
        }

        return redirect()->route('backend.region.country.lists')
            ->with('success', 'Ülke Düzenlendi');
    }

    public function remove($id)
    {
        $city = City::where('country_id', $id)->count();
        if ($city < 1) {
            Country::destroy($id);
            return redirect()->route('backend.region.country.lists')
                ->with('success', 'Ülke Silindi');
        } else {
            return redirect()->route('backend.region.country.lists')
                ->withErrors('Ülkeye Ait Şehir(ler) tanımlı olduğundan ülke silinemedi');
        }
    }
}
