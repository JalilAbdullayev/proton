<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                'address' => $request->address[$i],
                'title' => $request->title[$i],
                'subtitle' => $request->subtitle[$i],
                'description' => $request->description[$i],
                'call_text' => $request->call_text[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Əlaqə məlumatları saxlanıldı.');
    }
}
