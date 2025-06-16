<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Page;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = Page::where('name', 'home')->first();
        $aboutUsPage = Page::where('name', 'about_us')->first();
        $qualityPage = Page::where('name', 'quality')->first();
        $privacyPolicyPage = Page::where('name', 'privacy_policy')->first();
        $termsAndConditionsPage = Page::where('name', 'terms_and_conditions')->first();

        $sections = [
            // Home page sections
            [
                'name' => 'about',
                'title' => 'About Xiphoid',
                'page_id' => $homePage->id,
                'small_desc' => 'Delivering a Comprehensive Range of Global Healthcare Solutions',
            ],
            [
                'name' => 'products',
                'title' => 'Our Products',
                'page_id' => $homePage->id,
                'small_desc' => 'High-Quality Pharmaceutical Products.',
            ],
            [
                'name' => 'tagline',
                'title' => 'Committed to Health, Powered by Science',
                'page_id' => $homePage->id,
            ],
            [
                'name' => 'quality',
                'title' => 'Xiphoid Quality',
                'page_id' => $homePage->id,
                'small_desc' => 'Ensuring Premium Quality in Healthcare',
            ],

            // About Us page sections
            [
                'name' => 'welcome',
                'title' => 'Welcome to Xiphoid',
                'page_id' => $aboutUsPage->id,
                'small_desc' => 'About Us',
            ],
            [
                'name' => 'whom_we_serve',
                'title' => 'Whom We Serve?',
                'page_id' => $aboutUsPage->id,
                'is_entries' => 1,
            ],
            [
                'name' => 'manufacturing',
                'title' => 'Our Manufacturing',
                'page_id' => $aboutUsPage->id,
                'small_desc' => 'Where Quality Meets Innovation'
            ],

            // Quality page sections
            [
                'name' => 'quality_page',
                'title' => 'Committed to Quality, Driven by Innovation',
                'page_id' => $qualityPage->id,
            ],

            // Privacy Policy page sections
            [
                'name' => 'privacy_policy',
                'title' => 'Privacy Policy',
                'page_id' => $privacyPolicyPage->id,
            ],

            // Terms and Conditions page sections
            [
                'name' => 'terms_and_conditions',
                'title' => 'Terms and Conditions',
                'page_id' => $termsAndConditionsPage->id,
            ],
        ];

        $seederNames = collect($sections)->pluck('name')->toArray();
        Section::whereNotIn('name', $seederNames)->delete();

        foreach ($sections as $section) {

            $existingSection = Section::where('page_id', $section['page_id'])->where('name', $section['name'])->first();

            if ($existingSection) {
                $existingSection->update([
                    'is_entries' => $section['is_entries'] ?? 0,
                ]);
            } else {
                Section::create($section);
            }
        }
    }
}
