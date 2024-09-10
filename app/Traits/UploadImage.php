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

    public function multipleImg($request, $model, $imageModel, $directory, $foreignKey): void {
        if($request->file('images')) {
            $now = now()->format('YmdHis');
            $modelId = $model->id;
            $imagesData = array_map(static function($image, $index) use ($now, $modelId, $directory, $foreignKey) {
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $slug = Str::slug($name, '-') . '_' . $now . '.' . $extension;
                Storage::putFileAs("public/{$directory}/", $image, $slug);
                return [
                    $foreignKey => $modelId,
                    'image' => $slug,
                    'featured' => $index === 0 ? 1 : 0,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $request->file('images'), array_keys($request->file('images')));

            $imageModel::insert($imagesData);
        }
    }

    public function singleImg($request, $model) {
        if($request->file('image')) {
            if($model->image && Storage::exists('public/' . $model->image)) {
                Storage::delete('public/' . $model->image);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/', $file, $fileOriginalName);
            $model->update(['image' => 'images/' . $fileOriginalName]);
        }
    }
}
