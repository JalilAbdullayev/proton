<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Title;
use App\Models\TitleTranslate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class TitleController extends Controller {
    public function index(): ViewResponse {
        $home = Title::first();
        return View::make('admin.titles', compact('home'));
    }

    public function update(Request $request): RedirectResponse {
        $banner = Title::firstOrFail();
        for($i = 0; $i < count($request->lang); $i++) {
            TitleTranslate::whereHomeId($banner->id)->whereLang($request->lang[$i])->update([
                'services_title' => $request->services_title[$i],
                'services_subtitle' => $request->services_subtitle[$i],
                'portfolio_title' => $request->portfolio_title[$i],
                'portfolio_subtitle' => $request->portfolio_subtitle[$i],
                'clients_title' => $request->clients_title[$i],
                'team_title' => $request->team_title[$i],
                'team_subtitle' => $request->team_subtitle[$i],
                'team_description' => $request->team_description[$i],
                'blog_title' => $request->blog_title[$i],
                'blog_subtitle' => $request->blog_subtitle[$i]
            ]);
        }
        return Redirect::route('admin.titles')->withSuccess('Məlumatlar uğurla yeniləndi.');
    }
}
