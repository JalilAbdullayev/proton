<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Models\Team;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class FrontController extends Controller {
    public function index(): ViewResponse {
        $portfolio = Portfolio::whereStatus(1)->get();
        $team = Team::all();
        $banner = Banner::first();
        $clients = Client::whereStatus(1)->get();
        return View::make('index', compact('portfolio', 'team', 'banner', 'clients'));
    }

    public function about(): ViewResponse {
        $about = About::first();
        $clients = Client::whereStatus(1)->get();
        $team = Team::all();
        return View::make('about', compact('about', 'clients', 'team'));
    }

    public function contact(): ViewResponse {
        return View::make('contact');
    }

    public function service(string $slug): ViewResponse {
        $service = ServiceTranslate::whereSlug($slug)->join('services', 'services.id', '=', 'services_translate.service_id')->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->service_id)->get();
        return View::make('service', compact('service', 'otherServices'));
    }

    public function portfolio(): ViewResponse {
        $portfolio = Portfolio::paginate(6);
        return View::make('portfolio', compact('portfolio'));
    }
}
