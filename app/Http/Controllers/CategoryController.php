<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryTranslate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Category::all();
        return View::make('admin.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $category = Category::create();

        for($i = 0; $i < count($request->lang); $i++) {
            CategoryTranslate::create([
                'category_id' => $category->id,
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::back()->withSuccess('Kateqoriya uğurla yaradıldı.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): ViewResponse {
        return View::make('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse {
        for($i = 0; $i < count($request->lang); $i++) {
            CategoryTranslate::whereCategoryId($category->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'lang' => $request->lang[$i],
            ]);
        }

        return Redirect::route('admin.category.index')->withSuccess('Dəyişikliklər uğurla saxlanıldı.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse {
        $category->delete();
        return Response::json(['id' => $category->id]);
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $status = $category->status;
        $category->status = $status ? 0 : 1;
        $category->save();
        return Response::json([
            'id' => $id,
            'status' => $category->status
        ]);
    }
}
