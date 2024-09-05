<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class ClientController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Client::all();
        return View::make('admin.clients.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $client = new Client;
        $client->name = $request->name;
        $client->url = $request->url;
        if($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/clients/', $file, $fileOriginalName);
            $client->image = 'images/clients/' . $fileOriginalName;
        }
        $client->save();
        return Redirect::route('admin.client.index')->withSuccess('Müştəri əlavə olundu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): ViewResponse {
        return View::make('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client) {
        $client->name = $request->name;
        $client->url = $request->url;
        if($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/clients/', $file, $fileOriginalName);
            $client->update(['image' => 'images/clients/' . $fileOriginalName]);
        }
        $client->save();
        return Redirect::route('admin.client.index')->withSuccess('Müştəri məlumatları uğurla yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): JsonResponse {
        $client->delete();
        return Response::json(['id' => $client->id]);
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $client = Client::find($id);
        $status = $client->status;
        $client->status = $status ? 0 : 1;
        $client->save();
        return Response::json([
            'id' => $client->id,
            'status' => $client->status
        ]);
    }
}
