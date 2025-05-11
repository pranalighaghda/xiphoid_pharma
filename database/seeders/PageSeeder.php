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
                'is_sections' => '1',
            ],
            [
                'name' => 'about_us',
                'title' => 'About Us',
                'is_sections' => '1',
            ],
            [
                'name' => 'contact_us',
                'title' => 'Contact Us',
                'is_sections' => '0',
            ],
            [
                'name' => 'quality',
                'title' => 'Quality',
                'is_sections' => '1',
            ],
            [
                'name' => 'products',
                'title' => 'Our Products',
                'is_sections' => '0',
            ],
        ];

        $seederNames = collect($pages)->pluck('name')->toArray();
        Page::whereNotIn('name', $seederNames)->delete();

        foreach ($pages as $page) {
            $existingPage = Page::where('name', $page['name'])->first();

            if ($existingPage) {
                $existingPage->update([
                    'is_sections' => $page['is_sections'],
                ]);
            } else {
                Page::create($page);
            }
        }
    }
}
