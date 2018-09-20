<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\BackendController;
use App\Model\Products\Download;
use Illuminate\Http\Request;

class DownloadController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Dosyalar', 'link' => '']
        ]);

        $blade = [];
        $downloads = Download::paginate(config('backend.paginate'));
        $blade['downloads'] = $downloads;
        return view('backend.products.download_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Dosyalar', 'link' => route('backend.product.download.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        return view('backend.products.download_add');
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'filename' => 'required',
            'based' => 'required',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $save = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'filename' => $request->post('filename'),
            'based' => $request->post('based')
        ];
        Download::create($save);

        return redirect()->route('backend.product.download.lists')
            ->with('success', 'Dosya Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Dosyalar', 'link' => route('backend.product.download.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $download = Download::findOrFail($id);
        $blade['download'] = $download;

        return view('backend.products.download_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $update = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'filename' => $request->post('filename'),
            'based' => $request->post('based')
        ];
        Download::where('download_id', $id)->update($update);

        return redirect()->route('backend.product.download.lists')
            ->with('success', 'Dosya Düzenlendi');
    }

    public function remove($id)
    {
        Download::destroy($id);

        return redirect()->route('backend.product.download.lists')
            ->with('success', 'Dosya Silindi');
    }
}
