<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\SettingTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Settings::create([
            'logo' => 'logo.png',
            'favicon' => 'favicon.png'
        ]);
        SettingTranslate::create([
            'lang' => 'az',
            'title' => 'Proton',
            'description' => 'Proton',
            'keywords' => 'Proton',
            'author' => 'Proton',
            'settings_id' => Settings::first()->id
        ]);
        SettingTranslate::create([
            'lang' => 'en',
            'title' => 'Proton',
            'description' => 'Proton',
            'keywords' => 'Proton',
            'author' => 'Proton',
            'settings_id' => Settings::first()->id
        ]);
        SettingTranslate::create([
            'lang' => 'ru',
            'title' => 'Proton',
            'description' => 'Proton',
            'keywords' => 'Proton',
            'author' => 'Proton',
            'settings_id' => Settings::first()->id
        ]);
    }
}
