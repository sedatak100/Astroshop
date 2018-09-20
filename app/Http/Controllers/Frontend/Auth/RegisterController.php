<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\FrontendController;
use App\Mail\CustomerRegistered;
use App\Model\Customers\Customer;
use App\Model\Customers\CustomerGroup;
use App\Model\Pages\Page;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gsm' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'contract' => 'accepted',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Model\Customers\Customer
     */
    protected function create(array $data)
    {
        $customer_group = CustomerGroup::findOrFail(config('config.customer_group'));

        $customer = Customer::create([
            'status' => ($customer_group->approval == 1) ? 1 : 0,
            'customer_group_id' => $customer_group->id(),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'gsm' => $data['gsm'],
            'fax' => $data['fax'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Mail::send(new CustomerRegistered($customer));
        return $customer;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($user->status == 1) {
            $this->guard()->login($user);
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Üye Ol', 'link' => route('frontend.register')],
        ]);

        $blade = [];
        $customer_contract = config('config.customer_contract') ?? 0;
        $page = Page::find($customer_contract);
        $blade['customer_contract'] = $page;

        return view('frontend.auth.register', $blade);
    }
}
