<?php

namespace Database\Seeders;

use App\Models\SecondSection;
use App\Models\SecondSectionTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecondSectionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        SecondSection::create([
            'image' => 'first-section.png',
        ]);

        SecondSectionTranslate::create([
            'second_section_id' => SecondSection::first()->id,
            'lang' => 'en',
            'title' => 'Unleash Digital Potential',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        SecondSectionTranslate::create([
            'second_section_id' => SecondSection::first()->id,
            'lang' => 'az',
            'title' => 'Unleash Digital Potential',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        SecondSectionTranslate::create([
            'second_section_id' => SecondSection::first()->id,
            'lang' => 'ru',
            'title' => 'Unleash Digital Potential',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    }
}
