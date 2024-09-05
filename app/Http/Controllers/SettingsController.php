<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\SettingTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class SettingsController extends Controller {
    public function index(): ViewResponse {
        $settings = Settings::firstOrFail();
        return View::make('admin.settings', compact('settings'));
    }

    public function update(Request $request): RedirectResponse {
        $settings = Settings::firstOrFail();
        $this->uploadImage($request, 'logo', $settings, $settings->logo);
        $this->uploadImage($request, 'favicon', $settings, $settings->favicon);

        for($i = 0; $i < count($request->lang); $i++) {
            SettingTranslate::whereSettingsId($settings->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'author' => $request->author[$i],
                'keywords' => $request->keywords[$i],
                'description' => $request->description[$i]
            ]);
        }
        return Redirect::back()->withSuccess('Məlumatlar yeniləndi.');
    }

    public function uploadImage(Request $request, $input, $model, $modelInput): void {
        if($request->file($input)) {
            if($model && Storage::exists('public/' . $modelInput)) {
                Storage::delete('public/' . $modelInput);
            }
            $file = $request->file($input);
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/', $file, $fileOriginalName);
            $model->update([$input => 'images/' . $fileOriginalName]);
        }
    }
}
