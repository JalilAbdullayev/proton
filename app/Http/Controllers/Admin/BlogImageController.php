<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class BlogImageController extends Controller {
    public function index($id): ViewResponse {
        $data = BlogImage::whereArticleId($id)->orderBy('order')->get();
        $article = Blog::find($id)->translated->first();
        return View::make('admin.blog.images', compact('data', 'article'));
    }

    public function store(Request $request, $id): RedirectResponse {
        if($request->file('images')) {
            $now = now()->format('YmdHis');
            $isFirstImage = true;
            foreach($request->file('images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $slug = Str::slug($name, '-') . '_' . $now . '.' . $extension;
                $path = 'public/blog/';
                Storage::putFileAs($path, $image, $slug);
                $featured = $isFirstImage && !BlogImage::whereArticleId($id)->whereFeatured(1)->exists();
                $order = BlogImage::whereArticleId($id)->latest('order')->first()->order;
                if($order > 0) {
                    $last = $order + 1;
                } else {
                    $last = 1;
                }
                BlogImage::create([
                    'article_id' => $id,
                    'image' => $slug,
                    'featured' => $featured,
                    'order' => $last
                ]);
                $isFirstImage = false;
            }
        }
        return Redirect::back()->withSuccess('Şəkil(lər) uğurla əlavə edildi.');
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $image = BlogImage::findOrFail($id);
        $status = $image->status;
        $image->status = $status ? 0 : 1;
        $image->save();
        return Response::json([
            'id' => $id,
            'status' => $image->status
        ]);
    }

    public function featured($id): JsonResponse {
        $image = BlogImage::findOrFail($id);
        if($image) {
            BlogImage::whereArticleId($image->article_id)->update([
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
        BlogImage::destroy($id);
        return Response::json(['id' => $id]);
    }

    public function sort(Request $request) {
        $order_data = $request['data'];
        try {
            DB::beginTransaction();
            foreach($order_data as $data) {
                BlogImage::whereId($data['id'])->update(['order' => $data['order']]);
            }

            DB::commit();
            return Response::json('sort_success');
        } catch(Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(), 500);
        }
    }
}
