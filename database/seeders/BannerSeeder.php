<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerTranslate;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Banner::create();
        BannerTranslate::create([
            'banner_id' => Banner::first()->id,
            'lang' => 'en',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence'
        ]);
        BannerTranslate::create([
            'banner_id' => Banner::first()->id,
            'lang' => 'az',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence'
        ]);
        BannerTranslate::create([
            'banner_id' => Banner::first()->id,
            'lang' => 'ru',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence'
        ]);
    }
}
