<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'services' => Service::active()->ordered()->get(),
            'site_config' => $this->getSiteConfig(),
        ];
        
        return view('frontend.home', $data);
    }
    
    private function getSiteConfig()
    {
        return [
            'site_title' => 'Planifica+',
            'site_description' => 'Planificación estratégica empresarial, consultoría y crecimiento empresarial',
            'hero_title' => 'Planifica tu Éxito Empresarial',
            'hero_subtitle' => 'En Planifica+, combinamos innovación empresarial y estrategias digitales para generar resultados medibles y crecimiento sostenible.',
            'contact_email' => 'info@planificamas.com.mx',
            'contact_phone' => '+52 (55) 1234-5678',
            'facebook_url' => '#',
            'linkedin_url' => '#',
            'twitter_url' => '#',
            'instagram_url' => '#',
        ];
    }
}