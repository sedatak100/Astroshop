<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\BackendController;
use App\Model\Backend\UserPermission;
use App\Model\Users\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Yetkiler', 'link' => '']
        ]);

        $blade = [];
        $user_groups = UserGroup::all();
        $blade['user_groups'] = $user_groups;
        return view('backend.users.user_group_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Yetkiler', 'link' => route('backend.user.group.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $permissions = UserPermission::permissions();
        $blade['permissions'] = $permissions;
        return view('backend.users.user_group_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $_permissions = array();
        $permissions = $request->post('permission');
        foreach ($permissions as $permission) {
            $_permissions = array_merge($_permissions, explode(';', $permission));
        }

        UserGroup::create([
            'name' => $request->post('name'),
            'permission' => json_encode($_permissions)
        ]);

        return redirect()->route('backend.user.group.lists')
            ->with('success', 'Yetki Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Yetkiler', 'link' => route('backend.user.group.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $user_group = UserGroup::findOrFail($id);
        $permissions = UserPermission::permissions();
        $blade['user_group'] = $user_group;
        $blade['permissions'] = $permissions;
        return view('backend.users.user_group_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $this->formValidate($request);

        $_permissions = array();
        $permissions = $request->post('permission');
        foreach ($permissions as $permission) {
            $_permissions = array_merge($_permissions, explode(';', $permission));
        }

        UserGroup::where('user_group_id', $id)
            ->update([
                'permission' => json_encode($_permissions)
            ]);

        return redirect()->route('backend.user.group.lists')
            ->with('success', 'Yetkiler Güncellendi');
    }

    public function remove($id)
    {
        UserGroup::destroy($id);

        return redirect()->route('backend.user.group.lists')
            ->with('success', 'Yetki Silindi');
    }
}
