<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class AboutController extends Controller {
    use UploadImage;

    public function index(): ViewResponse {
        $about = About::firstOrFail();
        return View::make('admin.about', compact('about'));
    }

    public function update(Request $request): RedirectResponse {
        $about = About::firstOrFail();
        $this->singleImg($request, $about);

        for($i = 0; $i < count($request->lang); $i++) {
            AboutTranslate::whereAboutId($about->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'subtitle' => $request->subtitle[$i],
                'description' => $request->description[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Məlumatlar yeniləndi.');
    }
}
