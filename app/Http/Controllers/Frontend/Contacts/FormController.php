<?php

namespace App\Http\Controllers\Frontend\Contacts;

use App\Http\Controllers\FrontendController;
use App\Model\Contacts\Contact;
use Illuminate\Http\Request;

class FormController extends FrontendController
{
    public function form()
    {
        view()->share('breadcrumbs', [
            ['name' => 'İletişim', 'link' => '']
        ]);

        return view('frontend.contacts.contact_form');
    }

    public function added(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:150',
            'gsm' => 'nullable|numeric:max:25',
            'subject' => 'required|string|max:250',
            'message' => 'required|string|min:25',
        ]);

        Contact::create([
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'email' => $request->post('email'),
            'gsm' => $request->post('gsm'),
            'subject' => $request->post('subject'),
            'message' => $request->post('message'),
            'read' => 0,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        return redirect()->route('frontend.contact.form')
            ->with('success', 'Mesajınız bize ulaşmıştır, en kısa zamanda dönüş sağlanacaktır');
    }
}
