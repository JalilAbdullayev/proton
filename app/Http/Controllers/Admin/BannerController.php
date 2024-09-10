<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class BannerController extends Controller {
    public function index(): ViewResponse {
        $banner = Banner::firstOrFail();
        return View::make('admin.banner', compact('banner'));
    }

    public function update(Request $request): RedirectResponse {
        $banner = Banner::firstOrFail();
        for($i = 0; $i < count($request->lang); $i++) {
            BannerTranslate::whereBannerId($banner->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'subtitle' => $request->subtitle[$i]
            ]);
        }
        return Redirect::route('admin.banner')->withSuccess('Banner uğurla yeniləndi.');
    }
}
