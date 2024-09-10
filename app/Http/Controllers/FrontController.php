<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogTranslate;
use App\Models\Category;
use App\Models\CategoryTranslate;
use App\Models\Client;
use App\Models\FirstSection;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioTranslate;
use App\Models\Service;
use App\Models\ServiceTranslate;
use App\Models\Tag;
use App\Models\TagTranslate;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class FrontController extends Controller {
    public function index(): ViewResponse {
        $portfolio = Portfolio::whereStatus(1)->get();
        $team = Team::all();
        $banner = Banner::first();
        $clients = Client::whereStatus(1)->get();
        $blog = Blog::take(3)->get();
        $firstSection = FirstSection::first();
        return View::make('index', compact('portfolio', 'team', 'banner', 'clients', 'blog', 'firstSection'));
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

    public function article($slug): ViewResponse {
        $article = BlogTranslate::whereSlug($slug)->join('blog', 'blog.id', '=', 'article_id')->first();
        $category = Category::whereId($article->category_id)->first();
        $images = BlogImage::whereArticleId($article->article_id)->whereStatus(1)->whereFeatured(0)->get();
        $mainImage = 'blog/' . BlogImage::whereArticleId($article->article_id)->whereFeatured(1)->first()->image;
        $author = User::whereId($article->author_id)->first()->name;
        $tags = Blog::whereId($article->article_id)->first()->tags;
        $categories = Category::whereHas('articles')->get();
        $otherTags = Tag::whereHas('articles')->get();
        $articles = Blog::whereStatus(1)->where('id', '!=', $article->article_id)->take(3)->get();
        $allTags = Tag::whereHas('articles')->get();
        return View::make('article', compact('article', 'category', 'images', 'mainImage', 'author', 'tags', 'categories', 'otherTags', 'articles', 'allTags'));
    }

    public function blogCategory($slug): ViewResponse {
        $category = CategoryTranslate::whereSlug($slug)->first();
        $blog = Blog::whereCategoryId($category->category_id)->whereStatus(1)->paginate(6);
        return View::make('blog', compact('category', 'blog'));
    }

    public function blogTag($slug): ViewResponse {
        $tag = TagTranslate::whereSlug($slug)->first();
        $blog = Blog::whereHas('tags', function($query) use ($tag) {
            $query->where('tag_id', $tag->tag_id);
        })->whereStatus(1)->paginate(6);
        return View::make('blog', compact('tag', 'blog'));
    }

    public function blogSearch(Request $request): ViewResponse {
        $search = $request->input('search');
        $blog = Blog::whereHas('translated', function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->paginate(6);
        return View::make('blog', compact('blog', 'search'));
    }

    public function portfolioCategory($slug): ViewResponse {
        $category = CategoryTranslate::whereSlug($slug)->first();
        $portfolio = Portfolio::whereCategoryId($category->category_id)->whereStatus(1)->paginate(6);
        return View::make('portfolio', compact('category', 'portfolio'));
    }

    public function search(Request $request): ViewResponse {
        $search = $request->input('search');
        $blog = Service::whereHas('translated', function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->paginate(6);
        return View::make('blog', compact('blog', 'search'));
    }
}
