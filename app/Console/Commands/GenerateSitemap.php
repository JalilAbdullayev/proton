<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        $blogAzUrls = $this->urls('blog', 'blog_translate', 'article_id', 'az');
        $blogRuUrls = $this->urls('blog', 'blog_translate', 'article_id', 'ru');
        $blogEnUrls = $this->urls('blog', 'blog_translate', 'article_id', 'en');

        $categoryAzUrls = $this->urls('categories', 'categories_translate', 'category_id', 'az');
        $categoryRuUrls = $this->urls('categories', 'categories_translate', 'category_id', 'ru');
        $categoryEnUrls = $this->urls('categories', 'categories_translate', 'category_id', 'en');

        $portfolioAzUrls = $this->urls('portfolio', 'portfolio_translate', 'project_id', 'az');
        $portfolioRuUrls = $this->urls('portfolio', 'portfolio_translate', 'project_id', 'ru');
        $portfolioEnUrls = $this->urls('portfolio', 'portfolio_translate', 'project_id', 'en');

        $serviceAzUrls = $this->urls('services', 'services_translate', 'service_id', 'az');
        $serviceRuUrls = $this->urls('services', 'services_translate', 'service_id', 'ru');
        $serviceEnUrls = $this->urls('services', 'services_translate', 'service_id', 'en');

        $tagAzUrls = $this->urls('tags', 'tags_translate', 'tag_id', 'az');
        $tagRuUrls = $this->urls('tags', 'tags_translate', 'tag_id', 'ru');
        $tagEnUrls = $this->urls('tags', 'tags_translate', 'tag_id', 'en');

        $sitemap = Sitemap::create();

        $sitemap->add(env('APP_URL'));
        $sitemap->add(env('APP_URL') . 'en');
        $sitemap->add(env('APP_URL') . 'en/about');
        $sitemap->add(env('APP_URL') . 'en/contact');
        $sitemap->add(env('APP_URL') . 'en/blog');
        $sitemap->add(env('APP_URL') . 'en/portfolio');
        $sitemap->add(env('APP_URL') . 'ru');
        $sitemap->add(env('APP_URL') . 'ru/o-nas');
        $sitemap->add(env('APP_URL') . 'ru/svyaz');
        $sitemap->add(env('APP_URL') . 'ru/blog');
        $sitemap->add(env('APP_URL') . 'ru/portfolio');
        $sitemap->add(env('APP_URL') . 'haqqimizda');
        $sitemap->add(env('APP_URL') . 'blog');
        $sitemap->add(env('APP_URL') . 'elaqe');
        $sitemap->add(env('APP_URL') . 'portfolio');

        $this->addUrls($blogAzUrls, 'meqale/', $sitemap);
        $this->addUrls($blogRuUrls, 'ru/statya/', $sitemap);
        $this->addUrls($blogEnUrls, 'en/article/', $sitemap);

        $this->addUrls($portfolioAzUrls, 'layihe/', $sitemap);
        $this->addUrls($portfolioRuUrls, 'ru/proyekt/', $sitemap);
        $this->addUrls($portfolioEnUrls, 'en/project/', $sitemap);

        $this->addUrls($serviceAzUrls, 'xidmet/', $sitemap);
        $this->addUrls($serviceRuUrls, 'ru/usluga/', $sitemap);
        $this->addUrls($serviceEnUrls, 'en/service/', $sitemap);

        $this->addUrls($tagAzUrls, 'blog/etiket/', $sitemap);
        $this->addUrls($tagRuUrls, 'ru/blog/teq/', $sitemap);
        $this->addUrls($tagEnUrls, 'en/blog/tag/', $sitemap);

        foreach($categoryAzUrls as $categoryAzUrl) {
            $sitemap->add(env('APP_URL') . 'blog/kateqoriya/' . $categoryAzUrl);
            $sitemap->add(env('APP_URL') . 'portfolio/kateqoriya/' . $categoryAzUrl);
        }

        foreach($categoryRuUrls as $categoryRuUrl) {
            $sitemap->add(env('APP_URL') . 'ru/blog/kateqoria/' . $categoryRuUrl);
            $sitemap->add(env('APP_URL') . 'ru/portfolio/kateqoria/' . $categoryRuUrl);
        }

        foreach($categoryEnUrls as $categoryEnUrl) {
            $sitemap->add(env('APP_URL') . 'en/blog/category/' . $categoryEnUrl);
            $sitemap->add(env('APP_URL') . 'en/portfolio/category/' . $categoryEnUrl);
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }

    private function urls($table, $translate, $id, $lang): Collection {
        return DB::table($table)->join($translate, $id, '=', "$table.id")
            ->where('lang', $lang)->pluck('slug');
    }

    private function addUrls($urls, $path, $sitemap): void {
        foreach($urls as $url) {
            $sitemap->add(env('APP_URL') . $path . $url);
        }
    }
}
