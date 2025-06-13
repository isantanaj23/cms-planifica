<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Servicios - Planifica+</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8B5CF6;
            --primary-dark: #7C3AED;
            --primary-light: #A78BFA;
            --sidebar-bg: linear-gradient(180deg, #8B5CF6 0%, #7C3AED 100%);
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 0.25rem;
        }

        .sidebar-subtitle {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: rgba(255,255,255,0.3);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: white;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .user-details {
            flex: 1;
            font-size: 0.875rem;
        }

        .user-name {
            font-weight: 600;
            line-height: 1;
        }

        .user-email {
            opacity: 0.7;
            font-size: 0.75rem;
        }

        .logout-btn {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            width: 100%;
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .main-content {
            padding: 2rem;
        }

        .content-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        /* Estadísticas */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stats-primary .stats-icon { background: linear-gradient(135deg, #8B5CF6, #7C3AED); }
        .stats-success .stats-icon { background: linear-gradient(135deg, #10B981, #059669); }
        .stats-warning .stats-icon { background: linear-gradient(135deg, #F59E0B, #D97706); }
        .stats-info .stats-icon { background: linear-gradient(135deg, #3B82F6, #2563EB); }

        .stats-content h3 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            color: #1F2937;
        }

        .stats-content p {
            margin: 0;
            color: #6B7280;
            font-size: 0.9rem;
        }

        /* Botones */
        .btn-primary {
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid #9CA3AF;
            color: #6B7280;
            background: transparent;
            border-radius: 8px;
        }

        .btn-outline-secondary:hover {
            background: #9CA3AF;
            color: white;
        }

        /* Tabla */
        .table-header {
            background: linear-gradient(135deg, #F9FAFB, #F3F4F6);
            border-bottom: 2px solid #E5E7EB;
        }

        .table-header th {
            border: none;
            font-weight: 600;
            color: #374151;
            padding: 1rem 0.75rem;
        }

        .service-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .service-icon-small {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .service-details {
            flex: 1;
            min-width: 0;
        }

        .service-title {
            margin: 0 0 0.25rem;
            font-weight: 600;
            color: #1F2937;
            font-size: 1rem;
        }

        .service-description {
            margin: 0 0 0.5rem;
            color: #6B7280;
            font-size: 0.9rem;
        }

        .order-badge {
            background: #F3F4F6;
            color: #374151;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.25rem;
            justify-content: center;
        }

        .action-buttons .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        /* Switches */
        .form-switch .form-check-input {
            width: 2.5rem;
            height: 1.25rem;
            border-radius: 2rem;
            background-color: #D1D5DB;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #8B5CF6;
            border-color: #8B5CF6;
        }

        /* Cards */
        .card {
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        /* Formularios */
        .form-control, .form-select {
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            padding: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        /* Alertas */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
            color: #065F46;
            border-left: 4px solid #10B981;
        }

        .alert-danger {
            background: linear-gradient(135deg, #FEE2E2, #FECACA);
            color: #991B1B;
            border-left: 4px solid #EF4444;
        }

        /* Estado vacío */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #F3F4F6, #E5E7EB);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #9CA3AF;
            font-size: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .stats-card {
                flex-direction: column;
                text-align: center;
            }

            .service-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="/admin" class="sidebar-brand">Planifica+</a>
            <div class="sidebar-subtitle">Panel Admin</div>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="/admin" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.services.index') }}" class="nav-link active">
                    <i class="fas fa-cogs"></i>
                    Servicios
                </a>
            </div>
            <div class="nav-item">
                <a href="/admin/posts" class="nav-link">
                    <i class="fas fa-edit"></i>
                    Posts
                </a>
            </div>
            <div class="nav-item">
                <a href="/admin/categories" class="nav-link">
                    <i class="fas fa-folder"></i>
                    Categorías
                </a>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">Admin</div>
                    <div class="user-email">admin@planificamas.com</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i>Salir
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-wrapper">
        <div class="main-content">
            <!-- Header -->
            <div class="content-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-1 text-dark">Gestión de Servicios</h1>
                        <p class="text-muted mb-0">Administra tu catálogo de servicios</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="toggleView()">
                            <i id="view-icon" class="fas fa-th-large"></i>
                            <span id="view-text">Vista Tarjetas</span>
                        </button>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Nuevo Servicio
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filtros y Búsqueda -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-semibold">Buscar Servicios</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" id="search" placeholder="Buscar por título o descripción...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="status-filter" class="form-label fw-semibold">Estado</label>
                            <select class="form-select" id="status-filter">
                                <option value="">Todos los estados</option>
                                <option value="active">Solo Activos</option>
                                <option value="inactive">Solo Inactivos</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="sort-by" class="form-label fw-semibold">Ordenar por</label>
                            <select class="form-select" id="sort-by">
                                <option value="order">Orden</option>
                                <option value="title">Título</option>
                                <option value="created_at">Fecha de creación</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                                <i class="fas fa-times me-2"></i>Limpiar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card stats-primary">
                        <div class="stats-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $services->count() }}</h3>
                            <p>Total de Servicios</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card stats-success">
                        <div class="stats-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $services->where('is_active', true)->count() }}</h3>
                            <p>Servicios Activos</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card stats-warning">
                        <div class="stats-icon">
                            <i class="fas fa-pause-circle"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $services->where('is_active', false)->count() }}</h3>
                            <p>Servicios Inactivos</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card stats-info">
                        <div class="stats-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $services->where('created_at', '>=', now()->subWeek())->count() }}</h3>
                            <p>Nuevos (7 días)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vista Lista (por defecto) -->
            <div id="table-view" class="card shadow-sm">
                <div class="card-body p-0">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-header">
                                    <tr>
                                        <th>Servicio</th>
                                        <th width="100" class="text-center">Estado</th>
                                        <th width="80" class="text-center">Orden</th>
                                        <th width="120">Creado</th>
                                        <th width="150" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                    <tr class="service-row">
                                        <td>
                                            <div class="service-info">
                                                <div class="service-icon-small">
                                                    <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                                                </div>
                                                <div class="service-details">
                                                    <h6 class="service-title">{{ $service->title }}</h6>
                                                    <p class="service-description">{{ Str::limit($service->description, 100) }}</p>
                                                    @if($service->slug)
                                                        <span class="badge bg-light text-dark">{{ $service->slug }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input status-toggle" 
                                                       type="checkbox" 
                                                       data-id="{{ $service->id }}"
                                                       {{ $service->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="order-badge">{{ $service->order ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $service->created_at->format('d/m/Y') }}
                                                <br>
                                                {{ $service->created_at->format('H:i') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.services.edit', $service) }}" 
                                                   class="btn btn-sm btn-outline-success" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteService({{ $service->id }}, '{{ $service->title }}')"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h5>No hay servicios disponibles</h5>
                            <p class="text-muted">Comienza creando tu primer servicio para mostrar aquí.</p>
                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Crear Primer Servicio
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vista Tarjetas (oculta por defecto) -->
            <div id="cards-view" class="row" style="display: none;">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 mb-4 service-card-item">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="service-icon-small">
                                    <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" 
                                           type="checkbox" 
                                           data-id="{{ $service->id }}"
                                           {{ $service->is_active ? 'checked' : '' }}>
                                </div>
                            </div>
                            <h6 class="service-title">{{ $service->title }}</h6>
                            <p class="service-description flex-grow-1">{{ Str::limit($service->description, 120) }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-light text-dark">Orden: {{ $service->order ?? 0 }}</span>
                                <small class="text-muted">{{ $service->created_at->format('d/m/Y') }}</small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-success flex-fill">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <button class="btn btn-sm btn-outline-danger" 
                                        onclick="deleteService({{ $service->id }}, '{{ $service->title }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                    <p>¿Estás seguro de que deseas eliminar el servicio <strong id="service-name"></strong>?</p>
                    <p class="text-muted small">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let serviceToDelete = null;

        // Alternar entre vistas
        function toggleView() {
            const tableView = document.getElementById('table-view');
            const cardsView = document.getElementById('cards-view');
            const viewIcon = document.getElementById('view-icon');
            const viewText = document.getElementById('view-text');
            
            if (tableView.style.display === 'none') {
                tableView.style.display = 'block';
                cardsView.style.display = 'none';
                viewIcon.className = 'fas fa-th-large';
                viewText.textContent = 'Vista Tarjetas';
            } else {
                tableView.style.display = 'none';
                cardsView.style.display = 'flex';
                viewIcon.className = 'fas fa-list';
                viewText.textContent = 'Vista Lista';
            }
        }

        // Filtrar servicios (básico)
        function filterServices() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value;
            
            document.querySelectorAll('.service-row, .service-card-item').forEach(item => {
                const title = item.querySelector('.service-title').textContent.toLowerCase();
                const description = item.querySelector('.service-description').textContent.toLowerCase();
                const statusToggle = item.querySelector('.status-toggle');
                const isActive = statusToggle.checked;
                
                let matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                let matchesStatus = statusFilter === '' || 
                                   (statusFilter === 'active' && isActive) || 
                                   (statusFilter === 'inactive' && !isActive);
                
                item.style.display = matchesSearch && matchesStatus ? '' : 'none';
            });
        }

        // Limpiar filtros
        function clearFilters() {
            document.getElementById('search').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('sort-by').value = 'order';
            filterServices();
        }

        // Eliminar servicio
        function deleteService(id, name) {
            serviceToDelete = id;
            document.getElementById('service-name').textContent = name;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Confirmar eliminación
        function confirmDelete() {
            if (!serviceToDelete) return;
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/services/${serviceToDelete}`;
            form.innerHTML = `
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
            `;
            
            document.body.appendChild(form);
            form.submit();
        }

        // Inicializar eventos
        document.addEventListener('DOMContentLoaded', function() {
            // Búsqueda en tiempo real
            document.getElementById('search').addEventListener('input', filterServices);
            document.getElementById('status-filter').addEventListener('change', filterServices);
            
            // Switches de estado (funcionalidad básica)
            document.querySelectorAll('.status-toggle').forEach(toggle => {
                toggle.addEventListener('change', function() {
                    // Aquí podrías agregar la funcionalidad AJAX si quisieras
                    console.log('Estado cambiado para servicio ID:', this.dataset.id);
                });
            });
        });
    </script>
</body>
</html>