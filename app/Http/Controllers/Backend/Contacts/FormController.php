<?php

namespace App\Http\Controllers\Backend\Contacts;

use App\Http\Controllers\BackendController;
use App\Model\Contacts\Contact;
use Illuminate\Http\Request;

class FormController extends BackendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'İletişim', 'link' => route('backend.contact.form.lists')],
            ['name' => 'Form Mesajları', 'link' => '']
        ]);

        $blade = [];

        $contacts = Contact::orderBy('created_at', 'DESC')
            ->paginate(config('backend.paginate'));
        $blade['contacts'] = $contacts;

        return view('backend.contacts.form_lists', $blade);
    }

    public function view($id)
    {
        $contact = Contact::findOrFail($id);

        view()->share('breadcrumbs', [
            ['name' => 'İletişim', 'link' => route('backend.contact.form.lists')],
            ['name' => 'Form Mesajları', 'link' => route('backend.contact.form.lists')],
            ['name' => 'Mesaj Detayı', 'link' => '']
        ]);

        $blade = [];
        $blade['contact'] = $contact;

        if ($contact->read == 0) {
            Contact::where('contact_id', $contact->id())->update([
                'read' => 1
            ]);
        }

        return view('backend.contacts.form_view', $blade);
    }

    public function remove($id)
    {
        Contact::destroy($id);

        return redirect()->route('backend.contact.form.lists')
            ->with('success', 'Form Mesajı Silindi');
    }
}
