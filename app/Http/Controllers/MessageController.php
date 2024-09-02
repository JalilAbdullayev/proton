<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View as ViewResponse;

class MessageController extends Controller {
    public function index(): ViewResponse {
        $messages = Message::all();
        return view('admin.message.index', compact('messages'));
    }

    public function show(int $id): ViewResponse {
        $message = Message::findOrFail($id);
        return view('admin.message.show', compact('message'));
    }

    public function store(Request $request): RedirectResponse {
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return Redirect::back()->with('success', 'Your message has been sent successfully.');
    }
}
