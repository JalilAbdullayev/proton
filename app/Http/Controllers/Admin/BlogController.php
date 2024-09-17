<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogTranslate;
use App\Models\Category;
use App\Models\Tag;
use App\Traits\UploadImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class BlogController extends Controller {
    use UploadImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Blog::orderBy('order')->get();
        return View::make('admin.blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        $categories = Category::whereStatus(1)->get();
        $tags = Tag::whereStatus(1)->get();
        return View::make('admin.blog.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $order = Blog::latest('order')->first()->order;
        if($order > 0) {
            $last = $order + 1;
        } else {
            $last = 1;
        }
        $blog = Blog::create([
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
            'order' => $last
        ]);
        if($request->tags) {
            $blog->tags()->sync($request->tags);
        }
        $blog->tags()->sync($request->tags);
        for($i = 0; $i < count($request->lang); $i++) {
            BlogTranslate::create([
                'article_id' => $blog->id,
                'lang' => $request->lang[$i],
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'full_text' => $request->full_text[$i],
                'date' => $request->date[$i],
            ]);
        }
        $this->multipleImg($request, $blog, BlogImage::class, 'blog', 'article_id');
        return Redirect::route('admin.blog.index')->withSuccess('Məqalə uğurla yaradıldı.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): ViewResponse {
        $categories = Category::whereStatus(1)->get();
        $tags = Tag::whereStatus(1)->get();
        return View::make('admin.blog.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): RedirectResponse {
        $blog->update([
            'category_id' => $request->category_id,
        ]);
        if($request->tags) {
            $blog->tags()->sync($request->tags);
        }
        for($i = 0; $i < count($request->lang); $i++) {
            BlogTranslate::whereArticleId($blog->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'full_text' => $request->full_text[$i],
                'date' => $request->date[$i],
            ]);
        }
        return Redirect::route('admin.blog.index')->withSuccess('Dəyişikliklər uğurla saxlanıldı.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse {
        $blog->delete();
        return Response::json(['id' => $blog->id]);
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $blog = Blog::findOrFail($id);
        $status = $blog->status;
        $blog->status = $status ? 0 : 1;
        $blog->save();
        return Response::json([
            'id' => $id,
            'status' => $blog->status
        ]);
    }

    public function sort(Request $request) {
        $order_data = $request['data'];
        try {
            DB::beginTransaction();
            foreach($order_data as $data) {
                Blog::whereId($data['id'])->update(['order' => $data['order']]);
            }

            DB::commit();
            return Response::json('sort_success');
        } catch(Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(), 500);
        }
    }
}
