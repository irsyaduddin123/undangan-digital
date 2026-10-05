<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::create([
            'name' => 'Basic',
            'price' => 25000,
            'features' => [
                'Template Undangan',
                'Countdown',
                'Google Maps',
                'Galeri Foto',
            ],
            'status' => 'active',
        ]);

        Package::create([
            'name' => 'Premium',
            'price' => 50000,
            'features' => [
                'Template Undangan',
                'Countdown',
                'Google Maps',
                'Galeri Foto',
                'RSVP',
                'Buku Tamu',
                'Love Story',
                'Musik',
            ],
            'status' => 'active',
        ]);

        Package::create([
            'name' => 'Exclusive',
            'price' => 100000,
            'features' => [
                'Semua Fitur Premium',
                'Custom Domain',
                'Unlimited Galeri',
                'Custom Musik',
            ],
            'status' => 'active',
        ]);
    }
}