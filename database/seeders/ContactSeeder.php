<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Contact::create([
            'email' => 'info@proton.az',
            'phone' => '+994101234567',
            'map' => '<iframe></iframe>',
        ]);
        ContactTranslate::create([
            'contact_id' => Contact::first()->id,
            'lang' => 'en',
            'address' => 'Address'
        ]);
        ContactTranslate::create([
            'contact_id' => Contact::first()->id,
            'lang' => 'az',
            'address' => 'Address'
        ]);
        ContactTranslate::create([
            'contact_id' => Contact::first()->id,
            'lang' => 'ru',
            'address' => 'Address'
        ]);
    }
}
