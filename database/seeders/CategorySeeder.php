<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Marketing Digital',
                'slug' => 'marketing-digital',
                'description' => 'Estrategias y tendencias en marketing digital, redes sociales y publicidad online.',
                'color' => '#3B82F6',
                'icon' => 'fas fa-bullhorn',
                'sort_order' => 1,
                'meta_title' => 'Marketing Digital - Planifica+',
                'meta_description' => 'Descubre las mejores estrategias de marketing digital para hacer crecer tu negocio.',
            ],
            [
                'name' => 'Estrategia Empresarial',
                'slug' => 'estrategia-empresarial',
                'description' => 'Planificación estratégica, crecimiento empresarial y optimización de procesos.',
                'color' => '#8B5CF6',
                'icon' => 'fas fa-chess',
                'sort_order' => 2,
                'meta_title' => 'Estrategia Empresarial - Planifica+',
                'meta_description' => 'Guías y consejos para desarrollar estrategias empresariales exitosas.',
            ],
            [
                'name' => 'Tecnología e Innovación',
                'slug' => 'tecnologia-innovacion',
                'description' => 'Últimas tendencias tecnológicas, herramientas digitales y procesos innovadores.',
                'color' => '#10B981',
                'icon' => 'fas fa-rocket',
                'sort_order' => 3,
                'meta_title' => 'Tecnología e Innovación - Planifica+',
                'meta_description' => 'Mantente al día con las últimas innovaciones tecnológicas para empresas.',
            ],
            [
                'name' => 'E-commerce & Ventas',
                'slug' => 'ecommerce-ventas',
                'description' => 'Comercio electrónico, técnicas de ventas y optimización de conversiones.',
                'color' => '#F59E0B',
                'icon' => 'fas fa-shopping-cart',
                'sort_order' => 4,
                'meta_title' => 'E-commerce & Ventas - Planifica+',
                'meta_description' => 'Aprende a optimizar tu tienda online y aumentar tus ventas.',
            ],
            [
                'name' => 'Liderazgo y Gestión',
                'slug' => 'liderazgo-gestion',
                'description' => 'Desarrollo de liderazgo, gestión de equipos y cultura organizacional.',
                'color' => '#EF4444',
                'icon' => 'fas fa-users',
                'sort_order' => 5,
                'meta_title' => 'Liderazgo y Gestión - Planifica+',
                'meta_description' => 'Desarrolla habilidades de liderazgo y gestión empresarial efectiva.',
            ],
            [
                'name' => 'Casos de Éxito',
                'slug' => 'casos-exito',
                'description' => 'Historias reales de transformación empresarial y casos de éxito de nuestros clientes.',
                'color' => '#06B6D4',
                'icon' => 'fas fa-trophy',
                'sort_order' => 6,
                'meta_title' => 'Casos de Éxito - Planifica+',
                'meta_description' => 'Conoce historias reales de empresas que lograron el éxito con nuestras estrategias.',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        $this->command->info('✅ Categorías creadas exitosamente!');
    }
}