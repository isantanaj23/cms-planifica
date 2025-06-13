<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Post;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Estadísticas básicas (sin filtros complejos)
        $stats = [
            'users' => User::count(),
            'services' => Service::count(),
            'posts' => Post::count(),
            'categories' => Category::count(),
        ];

        // Posts recientes (sin filtros de status)
        $recentPosts = Post::with(['category'])
                          ->orderBy('created_at', 'desc')
                          ->limit(5)
                          ->get();

        // Servicios recientes
        $recentServices = Service::orderBy('created_at', 'desc')
                                ->limit(3)
                                ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentServices'));
    }
}