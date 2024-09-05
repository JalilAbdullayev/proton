<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class SocialController extends Controller {
    public array $icons = [
        ['title' => 'Facebook', 'icon' => "<i class='fa-brands fa-facebook'></i>"],
        ['title' => 'Facebook F', 'icon' => "<i class='fa-brands fa-facebook-f'></i>"],
        ['title' => 'Facebook Dördbucaq', 'icon' => "<i class='fa-brands fa-square-facebook'></i>"],
        ['title' => 'LinkedIn', 'icon' => "<i class='fa-brands fa-linkedin'></i>"],
        ['title' => 'LinkedIn in', 'icon' => "<i class='fa-brands fa-linkedin-in'></i>"],
        ['title' => 'Instagram', 'icon' => "<i class='fa-brands fa-instagram'></i>"],
        ['title' => 'Instagram Dördbucaq', 'icon' => "<i class='fa-brands fa-square-instagram'></i>"],
        ['title' => 'WhatsApp', 'icon' => "<i class='fa-brands fa-whatsapp'></i>"],
        ['title' => 'WhatsApp Dördbucaq', 'icon' => "<i class='fa-brands fa-square-whatsapp'></i>"],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Social::all();
        return View::make('admin.social.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.social.create', [
            'icons' => $this->icons
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialRequest $request): RedirectResponse {
        Social::create([
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon
        ]);
        return Redirect::route('admin.socials.index')->withSuccess('Məlumat uğurla əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Social $social): ViewResponse {
        return View::make('admin.social.edit', compact('social'), [
            'icons' => $this->icons
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialRequest $request, Social $social): RedirectResponse {
        $social->update([
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon
        ]);
        return Redirect::route('admin.socials.index')->withSuccess('Məlumat uğurla yeniləndi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social): JsonResponse {
        $social->delete();
        return Response::json(['id' => $social->id]);
    }

    public function status(SocialRequest $request): JsonResponse {
        $id = $request->id;
        $social = Social::findOrFail($id);
        $status = $social->status;
        $social->status = $status ? 0 : 1;
        $social->save();
        return Response::json([
            'id' => $id,
            'status' => $social->status
        ]);
    }
}
