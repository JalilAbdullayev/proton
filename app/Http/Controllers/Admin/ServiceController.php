<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Traits\UploadImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class ServiceController extends Controller {
    use UploadImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Service::orderBy('order')->get();
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
        $order = Service::latest('order')->first()->order;
        if($order > 0) {
            $last = $order + 1;
        } else {
            $last = 1;
        }
        $service = Service::create([
            'image' => $fileOriginalName ? 'images/services/' . $fileOriginalName : null,
            'icon' => $request->icon,
            'order' => $last,
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
        Artisan::call('sitemap:generate');
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
        return View::make('admin.services.edit', compact('item'));
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
        Artisan::call('sitemap:generate');
        return Redirect::route('admin.services.index')->withSuccess('Xidmət uğurla yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): JsonResponse {
        $service->delete();
        Artisan::call('sitemap:generate');
        return Response::json(['id' => $service->id]);
    }

    public function sort(Request $request) {
        $order_data = $request['data'];
        try {
            DB::beginTransaction();
            foreach($order_data as $data) {
                Service::whereId($data['id'])->update(['order' => $data['order']]);
            }

            DB::commit();
            return Response::json('sort_success');
        } catch(Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(), 500);
        }
    }
}
