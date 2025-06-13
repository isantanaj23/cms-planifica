<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Planifica+ CMS</title>
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
        
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
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
        
        .service-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        
        .btn-group-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
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
            .btn-group-actions {
                flex-direction: column;
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
                    <a class="nav-link" href="/admin">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/services">
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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Servicios</li>
                    </ol>
                </nav>
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
            <div class="content-card">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">Gestión de Servicios</h4>
                        <p class="text-muted mb-0">Administra los servicios que ofrece Planifica+</p>
                    </div>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Servicio
                    </a>
                </div>

                <!-- Alertas -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Estadísticas -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-cogs fa-2x mb-2"></i>
                                <h3>{{ $services->count() }}</h3>
                                <small>Total Servicios</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h3>{{ $services->where('is_active', true)->count() }}</h3>
                                <small>Activos</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-pause-circle fa-2x mb-2"></i>
                                <h3>{{ $services->where('is_active', false)->count() }}</h3>
                                <small>Inactivos</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-sort-numeric-up fa-2x mb-2"></i>
                                <h3>{{ $services->max('order') ?? 0 }}</h3>
                                <small>Último Orden</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Servicios -->
                @if($services->count() > 0)
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="service-card h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="service-icon">
                                            <i class="{{ $service->icon }}"></i>
                                        </div>
                                        <span class="status-badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $service->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>
                                    
                                    <h5 class="mb-2">{{ $service->title }}</h5>
                                    <p class="text-muted small mb-3">{{ Str::limit($service->description, 100) }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Orden: {{ $service->order }}</small>
                                        <div class="btn-group-actions">
                                            <a href="{{ route('admin.services.edit', $service) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-{{ $service->is_active ? 'warning' : 'success' }} btn-sm"
                                                    onclick="toggleStatus({{ $service->id }})">
                                                <i class="fas fa-{{ $service->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteService({{ $service->id }}, '{{ $service->title }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-cogs fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay servicios registrados</h4>
                        <p class="text-muted">Comienza agregando tu primer servicio</p>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Crear Primer Servicio
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar el servicio <strong id="serviceName"></strong>?</p>
                    <p class="text-muted small">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Función para cambiar estado activo/inactivo
        function toggleStatus(serviceId) {
            console.log('Toggle status llamado para servicio:', serviceId);
            
            const url = `{{ url('admin/services') }}/${serviceId}/toggle-status`;
            console.log('URL:', url);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    console.log('Éxito - recargando página');
                    location.reload();
                } else {
                    console.error('Error en respuesta:', data);
                    alert('Error al cambiar el estado del servicio: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error en fetch:', error);
                alert('Error de conexión al cambiar el estado del servicio');
            });
        }

        // Función para eliminar servicio
        function deleteService(serviceId, serviceName) {
            document.getElementById('serviceName').textContent = serviceName;
            document.getElementById('deleteForm').action = `{{ url('admin/services') }}/${serviceId}`;
            
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
</body>
</html>