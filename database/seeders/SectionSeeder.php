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

        $sections = [
            // Home page sections
            [
                'name' => 'hero_section',
                'title' => 'Welcome to Xiphoid Pharma',
                'page_id' => $homePage->id,
                'small_desc' => 'Delivering innovative healthcare solutions for a better tomorrow.',
                'content' => 'At Xiphoid Pharma, we are committed to advancing global healthcare through innovative pharmaceutical solutions. Our dedication to research, quality, and sustainability makes us a trusted partner in health.',
            ],
            [
                'name' => 'features_section',
                'title' => 'Why Choose Us?',
                'page_id' => $homePage->id,
                'small_desc' => 'Our innovative approach to pharmaceutical solutions.',
                'content' => 'With cutting-edge research, a team of dedicated professionals, and a commitment to safety, we provide superior pharmaceutical products that improve lives globally.',
            ],
            [
                'name' => 'testimonial_section',
                'title' => 'What Our Clients Say',
                'page_id' => $homePage->id,
                'is_entries' => '1',
                'content' => '“Xiphoid Pharma has been instrumental in providing reliable and effective pharmaceutical solutions for our hospital. Their products are top-notch, and we trust them for the well-being of our patients.” - Dr. A. Patel, Medical Director.',
            ],

            // About Us page sections
            [
                'name' => 'company_history',
                'title' => 'Our History',
                'page_id' => $aboutUsPage->id,
                'small_desc' => 'Founded on a vision of better healthcare.',
                'content' => 'Xiphoid Pharma was founded in 2000 with the vision to provide world-class pharmaceutical solutions. Over the years, we have expanded our portfolio to include a wide range of essential medicines, earning trust globally.',
            ],
            [
                'name' => 'team_section',
                'title' => 'Meet Our Experts',
                'page_id' => $aboutUsPage->id,
                'is_entries' => '1',
                'content' => 'Our team consists of highly skilled professionals who are passionate about improving healthcare. From researchers to pharmaceutical specialists, every team member plays a crucial role in delivering the best solutions.',
            ],
            [
                'name' => 'mission_vision',
                'title' => 'Our Mission & Vision',
                'page_id' => $aboutUsPage->id,
                'is_entries' => '1',
                'content' => 'Our mission is to provide innovative, high-quality, and affordable pharmaceuticals that meet the healthcare needs of diverse populations. Our vision is to be a leading global pharmaceutical company, committed to improving health and wellness worldwide.',
            ],
        ];


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
