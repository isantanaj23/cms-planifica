<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio - Planifica+ CMS</title>
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
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(150, 78, 249, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .icon-preview {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 0.5rem;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
        }
        
        .icon-option {
            width: 60px;
            height: 60px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            color: #666;
        }
        
        .icon-option:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: scale(1.05);
        }
        
        .icon-option.selected {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: white;
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
        
        .char-counter {
            font-size: 0.875rem;
            color: #6c757d;
            text-align: right;
        }
        
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-section h5 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .service-info {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .service-info h5 {
            color: white;
            margin-bottom: 0.5rem;
        }
        
        .service-info .service-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .service-info .meta-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
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
            .icon-grid {
                grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
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
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.services.index') }}">
                        <i class="fas fa-cogs"></i>
                        Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/blog') }}">
                        <i class="fas fa-blog"></i>
                        Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/team') }}">
                        <i class="fas fa-users"></i>
                        Equipo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/portfolio') }}">
                        <i class="fas fa-briefcase"></i>
                        Portafolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/pricing') }}">
                        <i class="fas fa-dollar-sign"></i>
                        Precios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/messages') }}">
                        <i class="fas fa-envelope"></i>
                        Mensajes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/settings') }}">
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Servicios</a></li>
                        <li class="breadcrumb-item active">Editar: {{ $service->title }}</li>
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
                        <h4 class="mb-1">Editar Servicio</h4>
                        <p class="text-muted mb-0">Modifica la información del servicio</p>
                    </div>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <!-- Información del Servicio -->
                <div class="service-info">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="icon-preview">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h5>{{ $service->title }}</h5>
                            <div class="service-meta">
                                <span class="meta-item">
                                    <i class="fas fa-calendar"></i> 
                                    Creado: {{ $service->created_at->format('d/m/Y') }}
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-edit"></i> 
                                    Modificado: {{ $service->updated_at->format('d/m/Y') }}
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-{{ $service->is_active ? 'check-circle' : 'pause-circle' }}"></i> 
                                    {{ $service->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-sort-numeric-up"></i> 
                                    Orden: {{ $service->order }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form method="POST" action="{{ route('admin.services.update', $service) }}" id="serviceForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Información Básica -->
                    <div class="form-section">
                        <h5><i class="fas fa-info-circle"></i> Información Básica</h5>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título del Servicio *</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $service->title) }}" 
                                           required 
                                           maxlength="255"
                                           oninput="updateCharCount('title', 255)">
                                    <div class="char-counter">
                                        <span id="title-count">0</span>/255 caracteres
                                    </div>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Orden de Visualización</label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', $service->order) }}" 
                                           min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción del Servicio *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required 
                                      maxlength="2000"
                                      oninput="updateCharCount('description', 2000)">{{ old('description', $service->description) }}</textarea>
                            <div class="char-counter">
                                <span id="description-count">0</span>/2000 caracteres
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Icono -->
                    <div class="form-section">
                        <h5><i class="fas fa-icons"></i> Icono del Servicio</h5>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Vista Previa</label>
                                <div class="icon-preview" id="iconPreview">
                                    <i class="{{ $service->icon }}" id="previewIcon"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">Selecciona un Icono *</label>
                                <input type="hidden" 
                                       name="icon" 
                                       id="selectedIcon" 
                                       value="{{ old('icon', $service->icon) }}" 
                                       required>
                                
                                <div class="icon-grid">
                                    <!-- Iconos de servicios comunes -->
                                    <div class="icon-option {{ $service->icon == 'fas fa-cog' ? 'selected' : '' }}" data-icon="fas fa-cog">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-chart-line' ? 'selected' : '' }}" data-icon="fas fa-chart-line">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-shopping-cart' ? 'selected' : '' }}" data-icon="fas fa-shopping-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-bullhorn' ? 'selected' : '' }}" data-icon="fas fa-bullhorn">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-code' ? 'selected' : '' }}" data-icon="fas fa-code">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-search' ? 'selected' : '' }}" data-icon="fas fa-search">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-users' ? 'selected' : '' }}" data-icon="fas fa-users">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-paint-brush' ? 'selected' : '' }}" data-icon="fas fa-paint-brush">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-mobile-alt' ? 'selected' : '' }}" data-icon="fas fa-mobile-alt">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-rocket' ? 'selected' : '' }}" data-icon="fas fa-rocket">
                                        <i class="fas fa-rocket"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-lightbulb' ? 'selected' : '' }}" data-icon="fas fa-lightbulb">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-handshake' ? 'selected' : '' }}" data-icon="fas fa-handshake">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-globe-americas' ? 'selected' : '' }}" data-icon="fas fa-globe-americas">
                                        <i class="fas fa-globe-americas"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-shield-alt' ? 'selected' : '' }}" data-icon="fas fa-shield-alt">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-trophy' ? 'selected' : '' }}" data-icon="fas fa-trophy">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <div class="icon-option {{ $service->icon == 'fas fa-star' ? 'selected' : '' }}" data-icon="fas fa-star">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                
                                @error('icon')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Configuración -->
                    <div class="form-section">
                        <h5><i class="fas fa-sliders-h"></i> Configuración</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">URL de Imagen (Opcional)</label>
                                    <input type="url" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           value="{{ old('image', $service->image) }}" 
                                           placeholder="https://example.com/imagen.jpg">
                                    <div class="form-text">URL de una imagen relacionada con el servicio</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <strong>Servicio Activo</strong>
                                        </label>
                                    </div>
                                    <div class="form-text">Los servicios activos se muestran en el sitio web</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-danger" onclick="deleteService()">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar Servicio
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Formulario oculto para eliminar -->
                <form id="deleteForm" method="POST" action="{{ route('admin.services.destroy', $service) }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
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
                    <p>¿Estás seguro de que quieres eliminar el servicio <strong>{{ $service->title }}</strong>?</p>
                    <p class="text-muted small">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Contador de caracteres
        function updateCharCount(fieldId, maxLength) {
            const field = document.getElementById(fieldId);
            const counter = document.getElementById(fieldId + '-count');
            const currentLength = field.value.length;
            counter.textContent = currentLength;
            
            if (currentLength > maxLength * 0.9) {
                counter.style.color = '#dc3545';
            } else if (currentLength > maxLength * 0.7) {
                counter.style.color = '#ffc107';
            } else {
                counter.style.color = '#6c757d';
            }
        }

        // Selección de iconos
        document.querySelectorAll('.icon-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remover selección anterior
                document.querySelectorAll('.icon-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Seleccionar nuevo icono
                this.classList.add('selected');
                const iconClass = this.dataset.icon;
                
                // Actualizar campos
                document.getElementById('selectedIcon').value = iconClass;
                document.getElementById('previewIcon').className = iconClass;
            });
        });

        // Función para eliminar servicio
        function deleteService() {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        function confirmDelete() {
            document.getElementById('deleteForm').submit();
        }

        // Validación del formulario
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const icon = document.getElementById('selectedIcon').value;
            
            if (!title || !description || !icon) {
                e.preventDefault();
                alert('Por favor, completa todos los campos obligatorios');
                return false;
            }
        });

        // Inicializar contadores
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount('title', 255);
            updateCharCount('description', 2000);
        });
    </script>
</body>
</html>