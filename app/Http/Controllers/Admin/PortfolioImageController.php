<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class PortfolioImageController extends Controller {
    public function index($id): ViewResponse {
        $data = PortfolioImage::whereProjectId($id)->get();
        $project = Portfolio::find($id)->translated->first();
        return View::make('admin.portfolio.images', compact('data', 'project'));
    }

    public function store(Request $request, $id): RedirectResponse {
        if($request->file('images')) {
            $now = now()->format('YmdHis');
            $isFirstImage = true;
            foreach($request->file('images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $slug = Str::slug($name, '-') . '_' . $now . '.' . $extension;
                $path = 'public/portfolio/';
                Storage::putFileAs($path, $image, $slug);
                $featured = $isFirstImage && !PortfolioImage::whereProjectId($id)->whereFeatured(1)->exists();
                PortfolioImage::create([
                    'project_id' => $id,
                    'image' => $slug,
                    'featured' => $featured
                ]);
                $isFirstImage = false;
            }
        }
        return Redirect::back()->withSuccess('Şəkil(lər) uğurla əlavə edildi.');
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $image = PortfolioImage::findOrFail($id);
        $status = $image->status;
        $image->status = $status ? 0 : 1;
        $image->save();
        return Response::json([
            'id' => $id,
            'status' => $image->status
        ]);
    }

    public function featured($id): JsonResponse {
        $image = PortfolioImage::findOrFail($id);
        if($image) {
            PortfolioImage::whereProjectId($image->project_id)->update([
                'featured' => 0
            ]);
            $image->featured = 1;
            $image->save();
        }
        return Response::json([
            'id' => $id,
            'featured' => $image->featured
        ]);
    }

    public function delete($id): JsonResponse {
        PortfolioImage::destroy($id);
        return Response::json(['id' => $id]);
    }
}
