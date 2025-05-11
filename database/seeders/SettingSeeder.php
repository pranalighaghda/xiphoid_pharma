<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $settings = [
            ['title' => 'Email', 'field_type' => 'email', 'is_required' => true],
            ['title' => 'Address', 'field_type' => 'textarea', 'is_required' => true],
            ['title' => 'Phone No.1', 'field_type' => 'text', 'is_required' => true],
            ['title' => 'Phone No.2', 'field_type' => 'text', 'is_required' => false],
            ['title' => 'Facebook', 'field_type' => 'url', 'is_required' => false],
            ['title' => 'Instagram', 'field_type' => 'url', 'is_required' => false],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['title' => $setting['title']],
                ['field_type' => $setting['field_type'], 'is_required' => $setting['is_required']]
            );
        }
    }
}
