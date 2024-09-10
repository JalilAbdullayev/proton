<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FirstSection;
use App\Models\FirstSectionTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class FirstSectionController extends Controller {
    use UploadImage;

    public function index(): ViewResponse {
        $section = FirstSection::firstOrFail();
        return View::make('admin.first-section', compact('section'));
    }

    public function update(Request $request): RedirectResponse {
        $section = FirstSection::firstOrFail();
        $this->singleImg($request, $section);

        for($i = 0; $i < count($request->lang); $i++) {
            FirstSectionTranslate::whereFirstSectionId($section->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'subtitle' => $request->subtitle[$i],
                'description' => $request->description[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Məlumatlar yeniləndi.');
    }
}
