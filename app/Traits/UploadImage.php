<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadImage {
    public function langStoreImg($request, $directory) {
        if($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            if($directory !== null) {
                Storage::putFileAs('public/images/' . $directory . '/', $file, $fileOriginalName);
            } else {
                Storage::putFileAs('public/images/', $file, $fileOriginalName);
            }
        } else {
            $fileOriginalName = null;
        }

        return $fileOriginalName;
    }

    public function langUpdateImg($request, $model, $directory) {
        if($request->file('image')) {
            if($model->image) {
                Storage::delete('public/' . $model->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/' . $directory . '/', $file, $fileOriginalName);
            $model->update([
                'image' => 'images/' . $directory . '/' . $fileOriginalName,
            ]);
        }
    }
}
