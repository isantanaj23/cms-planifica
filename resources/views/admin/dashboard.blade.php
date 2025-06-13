<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Planifica+ CMS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #964ef9;
            --secondary-color: #3001ff;
            --accent-color: #472eff;
        }
        
        body {
            background: #f8f9fa;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .sidebar {
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 50%, var(--secondary-color) 100%);
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 0;
            z-index: 1000;
        }
        
        .sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .logo h4 {
            color: white;
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 0;
        }
        
        .topbar {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .content-area {
            padding: 2rem;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stats-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .stats-card .label {
            color: #7f8c8d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .recent-activity {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid #f8f9fa;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h4><i class="fas fa-chart-line"></i> Planifica+</h4>
            <small class="text-white-50">Panel de Administración</small>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/services">
                        <i class="fas fa-cogs"></i>
                        Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/blog">
                        <i class="fas fa-blog"></i>
                        Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/team">
                        <i class="fas fa-users"></i>
                        Equipo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/portfolio">
                        <i class="fas fa-briefcase"></i>
                        Portafolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/pricing">
                        <i class="fas fa-dollar-sign"></i>
                        Precios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/messages">
                        <i class="fas fa-envelope"></i>
                        Mensajes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/settings">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Dashboard</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Bienvenido, {{ Auth::user()->name }}</span>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/">Ver Sitio Web</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h2>¡Bienvenido al CMS de Planifica+! 🚀</h2>
                <p class="mb-0">Gestiona todo el contenido de tu sitio web desde este panel de control.</p>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="stats-card">
                        <div class="icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="number">6</div>
                        <div class="label">Servicios</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card">
                        <div class="icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                            <i class="fas fa-blog"></i>
                        </div>
                        <div class="number">3</div>
                        <div class="label">Artículos</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card">
                        <div class="icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="number">0</div>
                        <div class="label">Mensajes</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card">
                        <div class="icon" style="background: linear-gradient(135deg, #27ae60, #229954);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="number">3</div>
                        <div class="label">Equipo</div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-md-8">
                    <div class="recent-activity">
                        <h5 class="mb-3">Actividad Reciente</h5>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--primary-color);">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <strong>CMS Instalado</strong>
                                <div class="text-muted small">Sistema de gestión de contenidos configurado correctamente</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: #27ae60;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <strong>Usuario Administrador Creado</strong>
                                <div class="text-muted small">Cuenta de administrador configurada</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: #3498db;">
                                <i class="fas fa-database"></i>
                            </div>
                            <div>
                                <strong>Base de Datos Configurada</strong>
                                <div class="text-muted small">Todas las tablas creadas correctamente</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="recent-activity">
                        <h5 class="mb-3">Acciones Rápidas</h5>
                        <div class="d-grid gap-2">
                            <a href="/admin/services" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Servicio
                            </a>
                            <a href="/admin/blog" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i> Escribir Artículo
                            </a>
                            <a href="/admin/messages" class="btn btn-outline-secondary">
                                <i class="fas fa-envelope"></i> Ver Mensajes
                            </a>
                            <a href="/" class="btn btn-outline-success" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Ver Sitio Web
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>