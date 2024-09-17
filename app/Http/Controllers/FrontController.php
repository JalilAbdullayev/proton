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
use App\Models\Title;
use App\Models\SecondSection;
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
        $lang = ['az' => '', 'ru' => '/ru', 'en' => '/en'];
        $portfolio = Portfolio::whereStatus(1)->get();
        $team = Team::orderBy('order')->get();
        $banner = Banner::first();
        $clients = Client::whereStatus(1)->get();
        $blog = Blog::take(3)->get();
        $firstSection = FirstSection::first();
        $secondSection = SecondSection::first();
        $home = Title::first();
        return View::make('index', compact('portfolio', 'team', 'banner', 'clients', 'blog', 'firstSection', 'secondSection', 'home', 'lang'));
    }

    public function about(): ViewResponse {
        $lang = ['az' => '/haqqimizda', 'ru' => '/ru/o-nas', 'en' => '/en/about'];
        $about = About::first();
        $clients = Client::whereStatus(1)->orderBy('order')->get();
        $team = Team::orderBy('order')->get();
        $home = Title::first();
        return View::make('about', compact('about', 'clients', 'team', 'home', 'lang'));
    }

    public function contact(): ViewResponse {
        $lang = ['az' => '/elaqe', 'ru' => '/ru/svyaz', 'en' => '/en/contact'];
        return View::make('contact', compact('lang'));
    }

    public function service(string $slug): ViewResponse {
        $home = Title::first();
        $service = ServiceTranslate::whereSlug($slug)->join('services', 'services.id', '=', 'services_translate.service_id')->first();
        $otherServices = Service::where('id', '!=', $service->service_id)->orderBy('order')->get();
        $slugs = ServiceTranslate::whereServiceId($service->service_id)->get();
        $lang = ['az' => '/xidmet/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/usluga/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/service/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('service', compact('service', 'otherServices', 'lang', 'home'));
    }

    public function portfolio(): ViewResponse {
        $lang = ['az' => '/portfolio', 'ru' => '/ru/portfolio', 'en' => '/en/portfolio'];
        $portfolio = Portfolio::whereStatus(1)->orderBy('order')->paginate(6);
        return View::make('portfolio', compact('portfolio', 'lang'));
    }

    public function project($slug): ViewResponse {
        $project = PortfolioTranslate::whereSlug($slug)->join('portfolio', 'portfolio.id', '=', 'project_id')->first();
        $category = Category::whereId($project->category_id)->first();
        $status = PortfolioTranslate::whereProjectId($project->project_id)->pluck('status')->first();
        $images = PortfolioImage::whereProjectId($project->project_id)->whereStatus(1)->whereFeatured(0)->orderBy('order')->get();
        $mainImage = 'portfolio/' . PortfolioImage::whereProjectId($project->project_id)->whereFeatured(1)->first()->image;
        $slugs = PortfolioTranslate::whereProjectId($project->project_id)->get();
        $lang = ['az' => '/layihe/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/proyekt/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/project/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('project', compact('project', 'category', 'status', 'mainImage', 'images', 'lang'));
    }

    public function blog(): ViewResponse {
        $lang = ['az' => '/blog', 'ru' => '/ru/blog', 'en' => '/en/blog'];
        $blog = Blog::whereStatus(1)->orderBy('order')->paginate(6);
        return View::make('blog', compact('blog', 'lang'));
    }

    public function article($slug): ViewResponse {
        $article = BlogTranslate::whereSlug($slug)->join('blog', 'blog.id', '=', 'article_id')->first();
        $category = Category::whereId($article->category_id)->first();
        $images = BlogImage::whereArticleId($article->article_id)->whereStatus(1)->whereFeatured(0)->orderBy('order')->get();
        $mainImage = 'blog/' . BlogImage::whereArticleId($article->article_id)->whereFeatured(1)->first()->image;
        $author = User::whereId($article->author_id)->first()->name;
        $tags = Blog::whereId($article->article_id)->first()->tags;
        $categories = Category::whereHas('articles')->get();
        $otherTags = Tag::whereHas('articles')->get();
        $articles = Blog::whereStatus(1)->where('id', '!=', $article->article_id)->orderBy('order')->take(3)->get();
        $allTags = Tag::whereHas('articles')->get();
        $slugs = BlogTranslate::whereArticleId($article->article_id)->get();
        $lang = ['az' => '/meqale/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/statya/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/article/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('article', compact('article', 'category', 'images', 'mainImage', 'author', 'tags', 'categories', 'otherTags', 'articles', 'allTags', 'lang'));
    }

    public function blogCategory($slug): ViewResponse {
        $category = CategoryTranslate::whereSlug($slug)->first();
        $blog = Blog::whereCategoryId($category->category_id)->whereStatus(1)->orderBy('order')->paginate(6);
        $slugs = CategoryTranslate::whereCategoryId($category->category_id)->get();
        $lang = ['az' => '/blog/kateqoriya/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/blog/kateqoria/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/blog/category/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('blog', compact('category', 'blog', 'lang'));
    }

    public function blogTag($slug): ViewResponse {
        $tag = TagTranslate::whereSlug($slug)->first();
        $blog = Blog::whereHas('tags', function($query) use ($tag) {
            $query->where('tag_id', $tag->tag_id);
        })->whereStatus(1)->orderBy('order')->paginate(6);
        $slugs = TagTranslate::whereTagId($tag->tag_id)->get();
        $lang = ['az' => '/blog/etiket/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/blog/teq/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/blog/tag/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('blog', compact('tag', 'blog', 'lang'));
    }

    public function blogSearch(Request $request): ViewResponse {
        $search = $request->input('search');
        $lang = ['az' => '/blog/axtar/?search=' . $search, 'ru' => '/ru/blog/poisk/?search=' . $search, 'en' => '/en/blog/search/?search=' . $search];
        $blog = Blog::whereHas('translated', function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('order')->paginate(6);
        return View::make('blog', compact('blog', 'search', 'lang'));
    }

    public function portfolioCategory($slug): ViewResponse {
        $category = CategoryTranslate::whereSlug($slug)->first();
        $portfolio = Portfolio::whereCategoryId($category->category_id)->whereStatus(1)->orderBy('order')->paginate(6);
        $slugs = CategoryTranslate::whereCategoryId($category->category_id)->get();
        $lang = ['az' => '/portfolio/kateqoriya/' . $slugs->where('lang', 'az')->first()->slug,
            'ru' => '/ru/portfolio/kateqoria/' . $slugs->where('lang', 'ru')->first()->slug,
            'en' => '/en/portfolio/category/' . $slugs->where('lang', 'en')->first()->slug];
        return View::make('portfolio', compact('category', 'portfolio', 'lang'));
    }

    public function search(Request $request): ViewResponse {
        $search = $request->input('search');
        $lang = ['az' => '/axtar/?search=' . $search, 'ru' => '/ru/poisk/?search=' . $search, 'en' => '/en/search/?search=' . $search];
        $blog = Service::whereHas('translated', function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('order')->paginate(6);
        return View::make('blog', compact('blog', 'search', 'lang'));
    }
}
