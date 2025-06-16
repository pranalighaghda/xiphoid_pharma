<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => 'home',
                'title' => 'Home',
                'is_sections' => 1,
            ],
            [
                'name' => 'about_us',
                'title' => 'About Us',
                'is_sections' => 1,
            ],
            [
                'name' => 'contact_us',
                'title' => 'Contact Us',
            ],
            [
                'name' => 'quality',
                'title' => 'Quality',
                'is_sections' => 1,
            ],
            [
                'name' => 'products',
                'title' => 'Our Products',
            ],
            [
                'name' => 'privacy_policy',
                'title' => 'Privacy Policy',
                'is_sections' => 1,
            ],
            [
                'name' => 'terms_and_conditions',
                'title' => 'Terms and Conditions',
                'is_sections' => 1,
            ],

        ];

        $seederNames = collect($pages)->pluck('name')->toArray();
        Page::whereNotIn('name', $seederNames)->delete();

        foreach ($pages as $page) {
            $existingPage = Page::where('name', $page['name'])->first();

            if ($existingPage) {
                $existingPage->update([
                    'is_sections' => $page['is_sections'] ?? 0,
                ]);
            } else {
                Page::create($page);
            }
        }
    }
}
