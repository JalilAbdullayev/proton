<?php

namespace Database\Seeders;

use App\Models\Title;
use App\Models\TitleTranslate;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Title::create();
        TitleTranslate::create([
            'home_id' => Title::first()->id,
            'lang' => 'en',
            'services_title' => '',
            'services_subtitle' => '',
            'portfolio_title' => '',
            'portfolio_subtitle' => '',
            'clients_title' => '',
            'team_title' => '',
            'team_subtitle' => '',
            'blog_title' => '',
            'blog_subtitle' => '',
            'contact_title' => '',
            'contact_description' => '',
            'call_text' => ''
        ]);
        TitleTranslate::create([
            'home_id' => Title::first()->id,
            'lang' => 'az',
            'services_title' => '',
            'services_subtitle' => '',
            'portfolio_title' => '',
            'portfolio_subtitle' => '',
            'clients_title' => '',
            'team_title' => '',
            'team_subtitle' => '',
            'blog_title' => '',
            'blog_subtitle' => '',
            'contact_title' => '',
            'contact_description' => '',
            'call_text' => ''
        ]);
        TitleTranslate::create([
            'home_id' => Title::first()->id,
            'lang' => 'ru',
            'services_title' => '',
            'services_subtitle' => '',
            'portfolio_title' => '',
            'portfolio_subtitle' => '',
            'clients_title' => '',
            'team_title' => '',
            'team_subtitle' => '',
            'blog_title' => '',
            'blog_subtitle' => '',
            'contact_title' => '',
            'contact_description' => '',
            'call_text' => ''
        ]);
    }
}
