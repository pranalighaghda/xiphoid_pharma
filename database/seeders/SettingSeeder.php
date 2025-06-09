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
            ['name' => 'email', 'title' => 'Email', 'field_type' => 'email', 'is_required' => true],
            ['name' => 'address', 'title' => 'Address', 'field_type' => 'textarea', 'is_required' => true],
            ['name' => 'phone_no_1', 'title' => 'Phone No.1', 'field_type' => 'text', 'is_required' => true],
            ['name' => 'phone_no_2', 'title' => 'Phone No.2', 'field_type' => 'text', 'is_required' => false],
            ['name' => 'facebook', 'title' => 'Facebook', 'field_type' => 'url', 'is_required' => false],
            ['name' => 'instagram', 'title' => 'Instagram', 'field_type' => 'url', 'is_required' => false],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['name' => $setting['name']],
                ['title' => $setting['title'], 'field_type' => $setting['field_type'], 'is_required' => $setting['is_required']]
            );
        }
    }
}
