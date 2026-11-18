<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'image_path' => 'images/hero/hero-gorilla.webp',
                'title' => 'Discover Uganda. / Feel Alive.',
                'subtitle' => 'From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.',
                'link' => '/destinations',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/hero/hero-falls.webp',
                'title' => 'Murchison Falls. / Untamed Power.',
                'subtitle' => 'Witness the world\'s most powerful waterfall where the Nile crashes through a 7-meter gorge.',
                'link' => '/destinations/murchison-falls',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/hero/hero-bunyonyi.webp',
                'title' => 'Lake Bunyonyi. / Sacred Tranquility.',
                'subtitle' => 'Glide across 29 emerald islands enveloped by the terraced hills of southwestern Uganda.',
                'link' => '/destinations/lake-bunyonyi',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::firstOrCreate(
                ['image_path' => $slide['image_path']],
                $slide
            );
        }
    }
}
