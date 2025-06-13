<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Planifica+ Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #964ef9;
            --secondary-color: #3001ff;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .content-header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #8341e8;
            border-color: #8341e8;
            transform: translateY(-2px);
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .badge {
            font-size: 0.75em;
            padding: 6px 10px;
        }

        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-user {
            padding: 15px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar">
            <!-- Brand -->
            <div class="sidebar-brand">
                <h3 class="text-white mb-0">
                    <i class="fas fa-rocket me-2"></i>
                    Planifica<span class="fw-bold">+</span>
                </h3>
                <small class="text-white-50">Panel de Administración</small>
            </div>
            
            <!-- Navigation -->
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                </li>
                
                <!-- Servicios -->
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="fas fa-cogs me-2"></i>
                        Servicios
                        <span class="badge bg-light text-dark ms-auto">{{ \App\Models\Service::count() }}</span>
                    </a>
                </li>
                
                <!-- Blog Section -->
                <li class="nav-item mt-3">
                    <div class="px-3 mb-2">
                        <h6 class="text-white-50 text-uppercase mb-0" style="font-size: 0.7rem; letter-spacing: 1px;">
                            <i class="fas fa-blog me-2"></i>Blog
                        </h6>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                        <i class="fas fa-edit me-2"></i>
                        Posts
                        @php
                            $draftCount = \App\Models\Post::count();
                        @endphp
                        @if($draftCount > 0)
                            <span class="badge bg-warning text-dark ms-auto">{{ $draftCount }}</span>
                        @endif
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder me-2"></i>
                        Categorías
                        <span class="badge bg-info ms-auto">{{ \App\Models\Category::count() }}</span>
                    </a>
                </li>
                
                <!-- Enlaces Externos -->
                <li class="nav-item mt-3">
                    <div class="px-3 mb-2">
                        <h6 class="text-white-50 text-uppercase mb-0" style="font-size: 0.7rem; letter-spacing: 1px;">
                            <i class="fas fa-external-link-alt me-2"></i>Enlaces
                        </h6>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('blog.index') }}" target="_blank" class="nav-link">
                        <i class="fas fa-globe me-2"></i>
                        Ver Blog
                        <i class="fas fa-external-link-alt ms-auto"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('home') }}" target="_blank" class="nav-link">
                        <i class="fas fa-home me-2"></i>
                        Ver Sitio Web
                        <i class="fas fa-external-link-alt ms-auto"></i>
                    </a>
                </li>
            </ul>
            
            <!-- User Info -->
            <div class="sidebar-user">
                <div class="d-flex align-items-center text-white">
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        <small class="text-white-50">{{ Auth::user()->email }}</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content flex-grow-1">
            <!-- Header -->
            <div class="content-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">@yield('title', 'Dashboard')</h1>
                        @if(isset($breadcrumbs))
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    @foreach($breadcrumbs as $breadcrumb)
                                        @if($loop->last)
                                            <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                                        @else
                                            <li class="breadcrumb-item">