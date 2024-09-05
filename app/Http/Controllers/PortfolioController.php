<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioTranslate;
use App\Traits\UploadImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class PortfolioController extends Controller {
    use UploadImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Portfolio::all();
        return View::make('admin.portfolio.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        $categories = Category::whereStatus(1)->get();
        return View::make('admin.portfolio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $portfolio = Portfolio::create([
            'category_id' => $request->category_id,
        ]);
        for($i = 0; $i < count($request->lang); $i++) {
            PortfolioTranslate::create([
                'project_id' => $portfolio->id,
                'lang' => $request->lang[$i],
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'keywords' => $request->keywords[$i],
                'full_text' => $request->full_text[$i],
                'status' => $request->status[$i],
                'duration' => $request->duration[$i],
                'date' => $request->date[$i],
                'location' => $request->location[$i],
            ]);
        }
        $this->multipleImg($request, $portfolio, PortfolioImage::class, 'portfolio', 'project_id');

        return Redirect::route('admin.portfolio.index')->withSuccess('Proyekt uğurla əlavə edildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio): ViewResponse {
        $categories = Category::whereStatus(1)->get();
        return View::make('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio): RedirectResponse {
        $portfolio->update([
            'category_id' => $request->category_id,
        ]);
        for($i = 0; $i < count($request->lang); $i++) {
            PortfolioTranslate::whereProjectId($portfolio->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'description' => $request->description[$i],
                'keywords' => $request->keywords[$i],
                'full_text' => $request->full_text[$i],
                'status' => $request->status[$i],
                'duration' => $request->duration[$i],
                'date' => $request->date[$i],
                'location' => $request->location[$i],
            ]);
        }

        return Redirect::route('admin.portfolio.index')->withSuccess('Proyekt uğurla yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio): JsonResponse {
        $portfolio->delete();
        return Response::json(['id' => $portfolio->id]);
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $portfolio = Portfolio::findOrFail($id);
        $status = $portfolio->status;
        $portfolio->status = $status ? 0 : 1;
        $portfolio->save();
        return Response::json([
            'id' => $id,
            'status' => $portfolio->status
        ]);
    }
}
