<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Planificación y Estrategia',
                'description' => 'En Planifica+, la planificación no es documento, es una acción con resultados reales. Diseñamos y ejecutamos estrategias sólidas que aseguren crecimiento, eficiencia y rentabilidad.',
                'icon' => 'fas fa-chart-line',
                'is_active' => true,
                'order' => 1,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'E-commerce',
                'description' => 'Transforma tu visión en una tienda online efectiva y rentable. Creamos plataformas de comercio electrónico optimizadas para maximizar conversiones y ofrecer experiencias seguras.',
                'icon' => 'fas fa-shopping-cart',
                'is_active' => true,
                'order' => 2,
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Marketing Digital',
                'description' => 'Creamos planes de acción digitales personalizados y efectivos que alineen los objetivos de tu negocio con las oportunidades del mercado.',
                'icon' => 'fas fa-bullhorn',
                'is_active' => true,
                'order' => 3,
                'image' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Desarrollo Tecnológico',
                'description' => 'Creamos sitios web que no solo se ven bien, venden mejor. Cada diseño está optimizado para ofrecer experiencias memorables y maximizar conversiones.',
                'icon' => 'fas fa-code',
                'is_active' => true,
                'order' => 4,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'SEO & Analytics',
                'description' => 'Posicionamiento SEO y análisis de datos con Google Analytics para mejorar tu visibilidad online y tomar decisiones basadas en datos reales.',
                'icon' => 'fas fa-search',
                'is_active' => true,
                'order' => 5,
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Gestión del Cambio',
                'description' => 'Facilitamos la transformación organizacional con metodologías probadas para asegurar una adopción exitosa de nuevas estrategias y procesos.',
                'icon' => 'fas fa-users',
                'is_active' => true,
                'order' => 6,
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Branding Corporativo',
                'description' => 'Entendemos que tu marca es mucho más que un logotipo. Es una experiencia emocional que conecta con tu audiencia y genera confianza.',
                'icon' => 'fas fa-paint-brush',
                'is_active' => false,
                'order' => 7,
                'image' => 'https://images.unsplash.com/photo-1558655146-364adaf1fcc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Consultoría Empresarial',
                'description' => 'Servicios de consultoría estratégica pensados para empresas que buscan excelencia, liderazgo real y diferenciación en mercados competitivos.',
                'icon' => 'fas fa-handshake',
                'is_active' => false,
                'order' => 8,
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ];

        // Limpiar tabla primero
        Service::truncate();
        
        foreach ($services as $service) {
            $service['slug'] = Str::slug($service['title']);
            Service::create($service);
        }
    }
}