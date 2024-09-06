<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagTranslate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class TagController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Tag::all();
        return View::make('admin.tags.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $tag = Tag::create();

        for($i = 0; $i < count($request->lang); $i++) {
            TagTranslate::create([
                'tag_id' => $tag->id,
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::back()->withSuccess('Teq uğurla yaradıldı');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): ViewResponse {
        return View::make('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag): RedirectResponse {
        for($i = 0; $i < count($request->lang); $i++) {
            TagTranslate::whereTagId($tag->id)->whereLang($request->lang[$i])->update([
                'title' => $request->title[$i],
                'slug' => Str::slug($request->title[$i]),
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.tag.index')->withSuccess('Teq uğurla yeniləndi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): JsonResponse {
        $tag->delete();
        return Response::json(['id' => $tag->id]);
    }

    public function status(Request $request): JsonResponse {
        $id = $request->id;
        $tag = Tag::findOrFail($id);
        $status = $tag->status;
        $tag->status = $status ? 0 : 1;
        $tag->save();
        return Response::json([
            'id' => $id,
            'status' => $tag->status
        ]);
    }
}
