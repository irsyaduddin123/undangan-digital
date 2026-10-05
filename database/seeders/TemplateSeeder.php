<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        Template::create([
            'name' => 'Elegant Gold',
            'slug' => 'elegant-gold',
            'thumbnail' => 'templates/elegant-gold.jpg',
            'path' => 'templates.elegant-gold.index',
            'status' => 'active',
        ]);

        Template::create([
            'name' => 'Minimalist White',
            'slug' => 'minimalist-white',
            'thumbnail' => 'templates/minimalist-white.jpg',
            'path' => 'templates.minimalist-white.index',
            'status' => 'active',
        ]);

        Template::create([
            'name' => 'Dark Luxury',
            'slug' => 'dark-luxury',
            'thumbnail' => 'templates/dark-luxury.jpg',
            'path' => 'templates.dark-luxury.index',
            'status' => 'active',
        ]);
    }
}