<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\BackendController;
use App\Model\Users\User;
use App\Model\Users\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kullanıcılar', 'link' => '']
        ]);

        $blade = [];
        $users = User::paginate(config('backend.paginate'));
        $blade['users'] = $users;
        return view('backend.users.user_lists', $blade);
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kullanıcılar', 'link' => route('backend.user.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = [];
        $blade['user_groups'] = UserGroup::all();
        return view('backend.users.user_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            'user_group_id' => 'required|integer',
            'status' => 'required|integer',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|',
            'password' => 'nullable|min:6',
        ]);
    }

    public function added(Request $request)
    {
        $this->formValidate($request);

        $request->validate([
            'password' => 'required',
            'email' => 'unique:users,email',
        ]);

        User::create([
            'user_group_id' => $request->post('user_group_id'),
            'status' => $request->post('status'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password'))
        ]);

        return redirect()->route('backend.user.lists')
            ->with('success', 'Kullanıcı Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Kullanıcılar', 'link' => route('backend.user.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = [];
        $user = User::findOrFail($id);
        $blade['user'] = $user;
        $blade['user_groups'] = UserGroup::all();
        return view('backend.users.user_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $user = User::findOrFail($id);

        $this->formValidate($request);

        $request->validate([
            'email' => 'unique:users,email,' . $id . ',user_id',
        ]);

        if ($request->post('password') != '') {
            $password = Hash::make($request->post('password'));
        } else {
            $password = $user->password;
        }

        User::where('user_id', $user->id())->update([
            'user_group_id' => $request->post('user_group_id'),
            'status' => $request->post('status'),
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'email' => $request->post('email'),
            'password' => $password
        ]);

        return redirect()->route('backend.user.lists')
            ->with('success', 'Kullanıcı Düzenlendi');
    }

    public function remove($id)
    {
        User::destroy($id);

        return redirect()->route('backend.user.lists')
            ->with('success', 'Kullanıcı Silindi');
    }
}
