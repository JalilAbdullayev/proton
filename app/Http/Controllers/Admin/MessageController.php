<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View as ViewResponse;

class MessageController extends Controller {
    public function index(): ViewResponse {
        $data = Message::all();
        return view('admin.messages.index', compact('data'));
    }

    public function show(int $id): ViewResponse {
        $message = Message::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function store(Request $request): RedirectResponse {
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return Redirect::back()->withSuccess('Mesajınız uğurla göndərildi.');
    }

    public function delete(int $id): RedirectResponse {
        $message = Message::findOrFail($id);
        $message->delete();
        return Redirect::back()->withSuccess('Mesajınız uğurla silindi.');

    }
}
