<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Model\Pages\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function lists($id)
    {
        $breadcrumbs = [];
        if ($id > 0) {
            $page = Page::with('parent')->orderBy('order', 'ASC')->findOrFail($id);
            $breadcrumbs = $page->backendBreadcrumbs();
        }
        view()->share('breadcrumbs', array_merge([
            ['name' => 'Sayfalar', 'link' => route('backend.page.lists', ['id' => 0])]
        ], $breadcrumbs));

        $blade = [];
        $blade['id'] = $id;
        $pages = Page::orderBy('order', 'ASC')->where('parent_id', $id)->paginate(config('default.paginate'));
        $blade['pages'] = $pages;
        return view('backend.pages.page_lists', $blade);
    }

    public function add($id)
    {
        $breadcrumbs = [];
        if ($id > 0) {
            $page = Page::with('parent')->findOrFail($id);
            $breadcrumbs = $page->backendBreadcrumbs();
        }
        view()->share('breadcrumbs', array_merge([
            ['name' => 'Sayfalar', 'link' => route('backend.page.lists', ['id' => 0])]
        ], $breadcrumbs));

        $blade = [];
        $blade['id'] = $id;

        return view('backend.pages.page_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
            'hidden' => 'required|numeric'
        ]);
    }

    public function added($id, Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:pages,seo_name',
        ]);

        $save = [
            'status' => $request->post('status'),
            'hidden' => $request->post('hidden'),
            'parent_id' => $id,
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'short_description' => $request->post('short_description'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        Page::create($save);

        return redirect()->route('backend.page.lists', ['id' => $id])
            ->with('success', 'Sayfa Eklendi');
    }

    public function edit($id)
    {
        $page = Page::with('parent')->findOrFail($id);

        view()->share('breadcrumbs', array_merge([
            ['name' => 'Sayfalar', 'link' => route('backend.page.lists', ['id' => 0])]
        ], $page->backendBreadcrumbs()));

        $blade['page'] = $page;

        return view('backend.pages.page_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $page = Page::findOrFail($id);

        $this->formValidate($request);

        $request->validate([
            'seo_name' => 'required|unique:pages,seo_name,' . $id . ',page_id',
        ]);

        $update = [
            'status' => $request->post('status'),
            'hidden' => $request->post('hidden'),
            'name' => $request->post('name'),
            'seo_name' => $request->post('seo_name'),
            'short_description' => $request->post('short_description'),
            'description' => $request->post('description'),
            'image' => $request->post('image'),
            'icon' => $request->post('icon'),
            'meta_title' => $request->post('meta_title'),
            'meta_description' => $request->post('meta_description'),
            'meta_keyword' => $request->post('meta_keyword'),
            'order' => $request->post('order'),
        ];
        Page::where('page_id', $id)->update($update);

        return redirect()->route('backend.page.lists', ['id' => $page->parent_id])
            ->with('success', 'Sayfa Düzenlendi');
    }

    public function remove($id)
    {
        $page = Page::with('children')->findOrFail($id);
        if ($page->children->count() < 1) {
            Page::destroy($id);
            return redirect()->route('backend.page.lists', ['id' => $page->parent_id])
                ->with('success', 'Sayfa Silindi');
        } else {
            return redirect()->route('backend.page.lists', ['id' => $page->parent_id])
                ->withErrors('Sayfaya ait alt sayfalar olduğu için kategori silinemedi');
        }
    }
}
