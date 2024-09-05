<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class ContactController extends Controller {
    public function index(): ViewResponse {
        $contact = Contact::firstOrFail();
        return View::make('admin.contact', compact('contact'));
    }

    public function update(Request $request): RedirectResponse {
        $contact = Contact::firstOrFail();
        $contact->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'map' => $request->map
        ]);
        for($i = 0; $i < count($request->lang); $i++) {
            ContactTranslate::whereContactId($contact->id)->whereLang($request->lang[$i])->update([
                'address' => $request->address[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Əlaqə məlumatları saxlanıldı.');
    }
}
