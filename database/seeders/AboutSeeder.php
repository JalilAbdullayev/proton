<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        About::create([
            'image' => 'about.png',
        ]);
        AboutTranslate::create([
            'about_id' => About::first()->id,
            'lang' => 'en',
            'title' => 'About Us',
            'description' => 'About Us',
        ]);
        AboutTranslate::create([
            'about_id' => About::first()->id,
            'lang' => 'az',
            'title' => 'About Us',
            'description' => 'About Us',
        ]);
        AboutTranslate::create([
            'about_id' => About::first()->id,
            'lang' => 'ru',
            'title' => 'About Us',
            'description' => 'About Us',
        ]);
    }
}
