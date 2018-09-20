<?php

namespace App\Http\Controllers\Backend\Posters;

use App\Model\Posters\Poster;
use App\Model\Posters\PosterGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosterController extends Controller
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Posterler', 'link' => '']
        ]);

        $blade = [];
        $poster_groups = PosterGroup::paginate(config('default.paginate'));
        $blade['poster_groups'] = $poster_groups;
        return view('backend.posters.poster_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Posterler', 'link' => route('backend.poster.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['targets'] = Poster::targets();

        return view('backend.posters.poster_add', $blade);
    }

    public function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|numeric'
        ]);

        if ($request->has('poster')) {
            foreach ($request->post('poster') as $i => $poster) {
                $request->validate([
                    'poster.' . $i . '.image' => 'required',
                    'poster.' . $i . '.order' => 'required|numeric'
                ]);
            }
        }
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];
        $poster_group = PosterGroup::create($save);

        foreach ($request->post('poster') as $i => $poster) {
            Poster::create([
                'poster_group_id' => $poster_group->id(),
                'name' => $poster['name'],
                'description' => $poster['description'],
                'link' => $poster['link'],
                'target' => $poster['target'],
                'config' => $poster['config'],
                'config2' => $poster['config2'],
                'image' => $poster['image'],
                'image2' => $poster['image2'],
                'order' => $poster['order'],
            ]);
        }

        return redirect()->route('backend.poster.lists')
            ->with('success', 'Poster Eklendi');
    }

    public function edit($id, Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Posterler', 'link' => route('backend.poster.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];

        $poster_group = PosterGroup::where('poster_group_id', $id)->findOrFail($id);
        $blade['poster_group'] = $poster_group;
        $blade['targets'] = Poster::targets();

        return view('backend.posters.poster_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'status' => $request->post('status'),
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ];
        PosterGroup::where('poster_group_id', $id)->update($update);

        Poster::where('poster_group_id', $id)->delete();
        foreach ($request->post('poster') as $i => $poster) {
            Poster::create([
                'poster_group_id' => $id,
                'name' => $poster['name'],
                'description' => $poster['description'],
                'link' => $poster['link'],
                'target' => $poster['target'],
                'config' => $poster['config'],
                'config2' => $poster['config2'],
                'image' => $poster['image'],
                'image2' => $poster['image2'],
                'order' => $poster['order'],
            ]);
        }

        return redirect()->route('backend.poster.lists')
            ->with('success', 'Poster Düzenlendi');
    }

    public function remove($id)
    {
        PosterGroup::destroy($id);
        Poster::where('poster_group_id', $id)->delete();
        return redirect()->route('backend.poster.lists')
            ->with('success', 'Poster Silindi');
    }
}
