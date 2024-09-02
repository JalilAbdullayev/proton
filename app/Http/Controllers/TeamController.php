<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewResponse;

class TeamController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Team::all();
        return View::make('admin.team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        if($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/team/', $file, $fileOriginalName);
        }

        $member = Team::create([
            'image' => $fileOriginalName ? 'images/team/' . $fileOriginalName : null,
        ]);

        for($i = 0; $i < count($request->lang); $i++) {
            TeamTranslate::create([
                'member_id' => $member->id,
                'name' => $request->name[$i],
                'position' => $request->position[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.team.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): ViewResponse {
        $member = Team::whereId($id)->first();
        return View::make('admin.team.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse {
        $member = Team::findOrFail($id);
        if($request->file('image')) {
            if($member->image) {
                Storage::delete('public/' . $member->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y-H-i-s') . '.' . $extension;
            Storage::putFileAs('public/images/team/', $file, $fileOriginalName);
            $member->update([
                'image' => 'images/team/' . $fileOriginalName,
            ]);
        }

        for($i = 0; $i < count($request->lang); $i++) {
            TeamTranslate::whereMemberId($id)->whereLang($request->lang[$i])->update([
                'name' => $request->name[$i],
                'position' => $request->position[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.team.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse {
        Team::whereId($id)->delete();
        return Redirect::back();
    }
}
