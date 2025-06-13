<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->error('❌ No hay usuarios en la base de datos.');
            return;
        }

        $posts = [
            [
                'title' => '¿Por qué tu negocio necesita una estrategia de marketing digital en 2025?',
                'excerpt' => 'Descubre cómo una estrategia digital bien estructurada puede transformar tu empresa y generar resultados medibles en el mercado actual.',
                'content' => '<h2>La Era Digital ha Llegado para Quedarse</h2><p>En un mundo donde <strong>más del 85% de los consumidores</strong> buscan productos y servicios online antes de realizar una compra, tener presencia digital ya no es opcional: es fundamental para la supervivencia empresarial.</p><h3>¿Qué Hace Diferente al Marketing Digital?</h3><ul><li><strong>Medición precisa del ROI:</strong> Cada peso invertido se puede rastrear y optimizar</li><li><strong>Segmentación avanzada:</strong> Llega exactamente a tu audiencia ideal</li><li><strong>Escalabilidad:</strong> Crece tu alcance sin límites geográficos</li><li><strong>Interacción directa:</strong> Comunicación bidireccional con tus clientes</li></ul>',
                'category_slug' => 'marketing-digital',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'tags' => ['SEO', 'Estrategia Digital', 'ROI']
            ],
            [
                'title' => 'Embudos de ventas: Cómo convertir prospectos en clientes leales',
                'excerpt' => 'Aprende a diseñar y optimizar embudos de ventas efectivos que conviertan visitantes en clientes recurrentes y aumenten tu ROI.',
                'content' => '<h2>El Poder de los Embudos de Ventas Optimizados</h2><p>Un embudo de ventas bien diseñado puede ser la diferencia entre una empresa que sobrevive y una que <strong>domina su mercado</strong>.</p><h3>¿Qué es un Embudo de Ventas?</h3><p>Es el proceso sistemático que guía a tus prospectos desde el primer contacto hasta convertirse en clientes leales y promotores de tu marca.</p>',
                'category_slug' => 'ecommerce-ventas',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'is_featured' => false,
                'tags' => ['Conversiones', 'CRO', 'E-commerce']
            ],
            [
                'title' => 'SEO vs. SEM: ¿Cuál le conviene más a tu negocio?',
                'excerpt' => 'Conoce las diferencias entre SEO y SEM, y descubre cuál estrategia se adapta mejor a tus objetivos y presupuesto empresarial.',
                'content' => '<h2>SEO vs SEM: La Batalla por la Visibilidad Online</h2><p>¿Invertir en posicionamiento orgánico o en publicidad pagada? Esta es una de las preguntas más frecuentes que recibimos en <strong>Planifica+</strong>.</p>',
                'category_slug' => 'marketing-digital',
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'is_featured' => false,
                'tags' => ['SEO', 'Google Ads', 'Analytics']
            ],
        ];

        foreach ($posts as $postData) {
            $category = Category::where('slug', $postData['category_slug'])->first();
            $tags = $postData['tags'];
            unset($postData['category_slug'], $postData['tags']);

            $post = Post::create([
                ...$postData,
                'category_id' => $category->id,
                'user_id' => $user->id,
                'meta_title' => $postData['title'] . ' | Planifica+ Blog',
                'meta_description' => $postData['excerpt'],
            ]);

            // Asignar tags
            foreach ($tags as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $post->tags()->attach($tag->id);
                }
            }
        }

        $this->command->info('✅ Posts de ejemplo creados exitosamente!');
    }
}