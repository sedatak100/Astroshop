<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function username()
    {
        return 'email';
    }

    public function showLoginForm()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Üye Girişi', 'link' => route('frontend.login')],
        ]);

        return view('frontend.auth.login');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = 1;
        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->has('redirect')) {
            return redirect($request->post('redirect'))->withErrors([
                $this->username() => [trans('auth.failed')],
            ]);
        }

        return redirect()->route('frontend.login')->withErrors([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function redirectTo()
    {
        if (\request()->has('redirect')) {
            return \request()->post('redirect');
        }
        return route('frontend.account.view');
    }
}
