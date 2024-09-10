<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class ConsultantController extends Controller {
    public function index(): ViewResponse {
        $data = Consultant::all();
        return View::make('admin.consultants', compact('data'));
    }

    public function store(Request $request): RedirectResponse {
        Consultant::create([
            'contact' => $request->contact
        ]);
        return Redirect::back()->withSuccess('Müraciətiniz qeydə alındı.');
    }

    public function delete(int $id) {
        $consultant = Consultant::findOrFail($id);
        $consultant->delete();
        return Redirect::back()->withSuccess('Müraciət uğurla silindi.');
    }
}
