<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class ServiceController extends Controller {
    use UploadImage;

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
        return View::make('admin.services.create');
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
        return Redirect::route('admin.services.index');
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
    public function edit(Service $service) {
        $item = $service;
        return View::make('admin.services.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse {

        $this->langUpdateImg($request, $service, 'services');

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

        return Redirect::route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service) {
        $service->delete();
        return Redirect::route('admin.services.index');
    }
}
