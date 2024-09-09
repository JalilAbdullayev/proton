<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogTranslate;
use App\Models\Category;
use App\Models\Client;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioTranslate;
use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
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
        $service = ServiceTranslate::whereSlug($slug)->join('services', 'services.id', '=', 'services_translate.service_id')->first();
        $otherServices = Service::where('id', '!=', $service->service_id)->get();
        return View::make('service', compact('service', 'otherServices'));
    }

    public function portfolio(): ViewResponse {
        $portfolio = Portfolio::whereStatus(1)->paginate(6);
        return View::make('portfolio', compact('portfolio'));
    }

    public function project($slug): ViewResponse {
        $project = PortfolioTranslate::whereSlug($slug)->join('portfolio', 'portfolio.id', '=', 'project_id')->first();
        $category = Category::whereId($project->category_id)->first();
        $status = PortfolioTranslate::whereProjectId($project->project_id)->pluck('status')->first();
        $images = PortfolioImage::whereProjectId($project->project_id)->whereStatus(1)->whereFeatured(0)->get();
        $mainImage = 'portfolio/' . PortfolioImage::whereProjectId($project->project_id)->whereFeatured(1)->first()->image;
        return View::make('project', compact('project', 'category', 'status', 'mainImage', 'images'));
    }

    public function blog(): ViewResponse {
        $blog = Blog::whereStatus(1)->paginate(6);
        return View::make('blog', compact('blog'));
    }

    public function article($slug) {
        $article = BlogTranslate::whereSlug($slug)->join('blog', 'blog.id', '=', 'article_id')->first();
        $category = Category::whereId($article->category_id)->first();
        $images = BlogImage::whereArticleId($article->article_id)->whereStatus(1)->whereFeatured(0)->get();
        $mainImage = 'blog/' . BlogImage::whereArticleId($article->article_id)->whereFeatured(1)->first()->image;
        $author = User::whereId($article->author_id)->first()->name;
        $tags = Blog::whereId($article->article_id)->first()->tags;
        $categories = Category::whereHas('articles')->get();
        $otherTags = Tag::whereHas('articles')->get();
        $articles = Blog::whereStatus(1)->where('id', '!=', $article->article_id)->take(3)->get();
        return View::make('article', compact('article', 'category', 'images', 'mainImage', 'author', 'tags', 'categories', 'otherTags', 'articles'));
    }
}
