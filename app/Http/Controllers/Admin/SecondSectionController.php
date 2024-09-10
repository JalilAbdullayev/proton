<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecondSection;
use App\Models\SecondSectionTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class SecondSectionController extends Controller {
    use UploadImage;

    public function index(): ViewResponse {
        $section = SecondSection::firstOrFail();
        return View::make('admin.second-section', compact('section'));
    }

    public function update(Request $request): RedirectResponse {
        $section = SecondSection::firstOrFail();
        $this->singleImg($request, $section);

        for($i = 0; $i < count($request->lang); $i++) {
            SecondSectionTranslate::whereSecondSectionId($section->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'description' => $request->description[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Məlumatlar yeniləndi.');
    }
}
