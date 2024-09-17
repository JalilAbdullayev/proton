<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamTranslate;
use App\Traits\UploadImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class TeamController extends Controller {
    use UploadImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = Team::orderBy('order')->get();
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
        $fileOriginalName = $this->langStoreImg($request, 'team');
        $order = Team::latest('order')->first()->order;
        if($order > 0) {
            $last = $order + 1;
        } else {
            $last = 1;
        }
        $member = Team::create([
            'image' => $fileOriginalName ? 'images/team/' . $fileOriginalName : null,
            'order' => $last
        ]);

        for($i = 0; $i < count($request->lang); $i++) {
            TeamTranslate::create([
                'member_id' => $member->id,
                'name' => $request->name[$i],
                'position' => $request->position[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.team.index')->withSuccess('Üzv uğurla əlavə edildi.');
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
        $this->langUpdateImg($request, $member, 'team');

        for($i = 0; $i < count($request->lang); $i++) {
            TeamTranslate::whereMemberId($id)->whereLang($request->lang[$i])->update([
                'name' => $request->name[$i],
                'position' => $request->position[$i],
                'lang' => $request->lang[$i],
            ]);
        }
        return Redirect::route('admin.team.index')->withSuccess('Üzv məlumatları uğurla yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse {
        Team::whereId($id)->delete();
        return Response::json(['id' => $id]);
    }

    public function sort(Request $request) {
        $order_data = $request['data'];
        try {
            DB::beginTransaction();
            foreach($order_data as $data) {
                Team::whereId($data['id'])->update(['order' => $data['order']]);
            }

            DB::commit();
            return Response::json('sort_success');
        } catch(Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(), 500);
        }
    }
}
