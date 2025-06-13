<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => 'SEO', 'color' => '#10B981'],
            ['name' => 'Social Media', 'color' => '#3B82F6'],
            ['name' => 'Google Ads', 'color' => '#F59E0B'],
            ['name' => 'Facebook Ads', 'color' => '#1877F2'],
            ['name' => 'Estrategia Digital', 'color' => '#8B5CF6'],
            ['name' => 'ROI', 'color' => '#EF4444'],
            ['name' => 'Conversiones', 'color' => '#06B6D4'],
            ['name' => 'Analytics', 'color' => '#6366F1'],
            ['name' => 'E-commerce', 'color' => '#F59E0B'],
            ['name' => 'Branding', 'color' => '#EC4899'],
            ['name' => 'Content Marketing', 'color' => '#10B981'],
            ['name' => 'Email Marketing', 'color' => '#8B5CF6'],
            ['name' => 'CRO', 'color' => '#EF4444'],
            ['name' => 'UX/UI', 'color' => '#06B6D4'],
            ['name' => 'Growth Hacking', 'color' => '#10B981'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        $this->command->info('✅ Tags creados exitosamente!');
    }
}