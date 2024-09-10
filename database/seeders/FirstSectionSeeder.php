<?php

namespace Database\Seeders;

use App\Models\FirstSection;
use App\Models\FirstSectionTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FirstSectionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        FirstSection::create([
            'image' => 'first-section.png',
        ]);

        FirstSectionTranslate::create([
            'first_section_id' => FirstSection::first()->id,
            'lang' => 'en',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        FirstSectionTranslate::create([
            'first_section_id' => FirstSection::first()->id,
            'lang' => 'az',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        FirstSectionTranslate::create([
            'first_section_id' => FirstSection::first()->id,
            'lang' => 'ru',
            'title' => 'Unleash Digital Potential',
            'subtitle' => 'Empowering excellence',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    }
}
