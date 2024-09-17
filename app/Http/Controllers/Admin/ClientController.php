<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = Client::orderBy('order')->get();
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
        $order = Client::latest('order')->first()->order;
        if($order > 0) {
            $last = $order + 1;
        } else {
            $last = 1;
        }
        $client->name = $request->name;
        $client->url = $request->url;
        $client->order = $last;
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

    public function sort(Request $request) {
        $order_data = $request['data'];
        try {
            DB::beginTransaction();
            foreach($order_data as $data) {
                Client::whereId($data['id'])->update(['order' => $data['order']]);
            }

            DB::commit();
            return Response::json('sort_success');
        } catch(Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(), 500);
        }
    }
}
