<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Client;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class FrontController extends Controller {
    public function index(): ViewResponse {
        $services = Service::all();
        $portfolio = Portfolio::whereStatus(1)->get();
        $team = Team::all();
        $banner = Banner::first();
        $clients = Client::whereStatus(1)->get();
        return View::make('index', compact('services', 'portfolio', 'team', 'banner', 'clients'));
    }
}
