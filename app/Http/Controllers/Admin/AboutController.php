<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class AboutController extends Controller {
    public function index(): ViewResponse {
        $about = About::firstOrFail();
        return View::make('admin.about', compact('about'));
    }

    public function update(Request $request): RedirectResponse {
        $about = About::firstOrFail();
        if($request->file('image')) {
            if($about->image && Storage::exists('public/' . $about->image)) {
                Storage::delete('public/' . $about->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/', $file, $fileOriginalName);
            $about->update(['image' => 'images/' . $fileOriginalName]);
        }

        for($i = 0; $i < count($request->lang); $i++) {
            AboutTranslate::whereAboutId($about->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'description' => $request->description[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Məlumatlar yeniləndi.');
    }
}
