<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class ProfileController extends Controller {

    public function index(): ViewResponse {
        return View::make('admin.profile');
    }

    public function update(Request $request): RedirectResponse {
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return Redirect::back()->withSuccess('Profiliniz uğurla yeniləndi.');
    }

    public function delete(): RedirectResponse {
        Auth::user()->delete();
        return Redirect::route('login');
    }
}
