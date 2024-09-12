<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class ServiceController extends Controller {
    use UploadImage;

    public array $icons = [
        ['title' => 'Check', 'icon' => '<i class="fa-solid fa-check"></i>'],
        ['title' => 'Heart', 'icon' => '<i class="fa-solid fa-heart"></i>'],
        ['title' => 'Heart White', 'icon' => '<i class="fa-regular fa-heart"></i>'],
        ['title' => 'Info', 'icon' => '<i class="fa-solid fa-circle-info"></i>'],
        ['title' => 'Bolt', 'icon' => '<i class="fa-solid fa-bolt"></i>'],
        ['title' => 'Gear', 'icon' => '<i class="fa-solid fa-gear"></i>'],
        ['title' => 'Gears', 'icon' => '<i class="fa-solid fa-gears"></i>'],
        ['title' => 'Circle Up', 'icon' => '<i class="fa-solid fa-circle-up"></i>'],
        ['title' => 'Circle Up White', 'icon' => '<i class="fa-regular fa-circle-up"></i>'],
        ['title' => 'Clock', 'icon' => '<i class="fa-solid fa-clock"></i>'],
        ['title' => 'Clock White', 'icon' => '<i class="fa-regular fa-clock"></i>'],
        ['title' => 'Code', 'icon' => '<i class="fa-solid fa-code"></i>'],
        ['title' => 'Laptop Code', 'icon' => '<i class="fa-solid fa-laptop-code"></i>'],
        ['title' => 'Shield', 'icon' => '<i class="fa-solid fa-shield"></i>'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Service::all();
        return View::make('admin.services.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.services.create', ['icons' => $this->icons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'image.mimes' => 'Şəkilin formatı jpeg, png, jpg, gif, svg olmalıdır.',
            'image.max' => 'Şəkilin ölçüsü 2 MB-dan çox olmamalıdır.',
            'image.image' => 'Zəhmət olmasa, şəkil daxil edin.',
        ]);
        $fileOriginalName = $this->langStoreImg($request, 'services');
        $service = Service::create([
            'image' => $fileOriginalName ? 'images/services/' . $fileOriginalName : null,
            'icon' => $request->icon,
        ]);

        for($i = 0; $i < count($request->lang); $i++) {
            ServiceTranslate::create([
                'service_id' => $service->id,
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'keywords' => $request->keywords[$i],
                'full_text' => $request->full_text[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.services.index')->withSuccess('Xidmət uğurla əlavə edildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): ViewResponse {
        $item = $service;
        return View::make('admin.services.edit', compact('item'), ['icons' => $this->icons]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse {
        $this->langUpdateImg($request, $service, 'services');
        $service->update([
            'icon' => $request->icon,
        ]);

        for($i = 0; $i < count($request->lang); $i++) {
            ServiceTranslate::whereServiceId($service->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'keywords' => $request->keywords[$i],
                'full_text' => $request->full_text[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.services.index')->withSuccess('Xidmət uğurla yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): JsonResponse {
        $service->delete();
        return Response::json(['id' => $service->id]);
    }
}
