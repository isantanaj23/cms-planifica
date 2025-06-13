<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Servicio</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 15px 15px;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #007bff;
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-1px);
        }
        
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(50px, 1fr));
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .icon-option {
            width: 50px;
            height: 50px;
            border: 2px solid #dee2e6;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .icon-option:hover {
            border-color: #007bff;
            color: #007bff;
            transform: translateY(-2px);
        }
        
        .icon-option.selected {
            border-color: #007bff;
            background: #007bff;
            color: white;
        }
        
        .preview-card {
            background: white;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
        }
        
        .preview-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="max-width: 1200px;">
        <!-- Header -->
        <div class="page-header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h2 mb-1">➕ Crear Nuevo Servicio</h1>
                        <p class="mb-0 opacity-75">Agrega un nuevo servicio a tu catálogo</p>
                    </div>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Errores -->
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Corrige los siguientes errores:</strong>
                    </div>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <!-- Formulario -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.services.store') }}" method="POST">
                                @csrf
                                
                                <!-- Información Básica -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-info-circle text-primary"></i>
                                        Información Básica
                                    </h5>
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-bold">
                                                    Título del Servicio <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('title') is-invalid @enderror" 
                                                       id="title" 
                                                       name="title" 
                                                       value="{{ old('title') }}" 
                                                       required 
                                                       placeholder="Ej: Desarrollo Web Personalizado">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="order" class="form-label fw-bold">Orden</label>
                                                <input type="number" 
                                                       class="form-control @error('order') is-invalid @enderror" 
                                                       id="order" 
                                                       name="order" 
                                                       value="{{ old('order', 0) }}" 
                                                       min="0">
                                                <small class="text-muted">0 = primero</small>
                                                @error('order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-bold">
                                            Descripción <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" 
                                                  name="description" 
                                                  rows="4" 
                                                  required 
                                                  placeholder="Describe qué incluye este servicio...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Personalización Visual -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-palette text-primary"></i>
                                        Personalización Visual
                                    </h5>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="icon" class="form-label fw-bold">
                                                    Icono <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('icon') is-invalid @enderror" 
                                                       id="icon" 
                                                       name="icon" 
                                                       value="{{ old('icon', 'fas fa-cog') }}" 
                                                       required 
                                                       placeholder="fas fa-cog">
                                                <small class="text-muted">
                                                    Clase de <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a>
                                                </small>
                                                @error('icon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label fw-bold">URL de Imagen (Opcional)</label>
                                                <input type="url" 
                                                       class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" 
                                                       name="image" 
                                                       value="{{ old('image') }}" 
                                                       placeholder="https://ejemplo.com/imagen.jpg">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Iconos Populares -->
                                    <div class="bg-white p-3 rounded border">
                                        <label class="form-label fw-bold">Iconos populares (clic para seleccionar):</label>
                                        <div class="icon-grid">
                                            <button type="button" class="icon-option" data-icon="fas fa-code">
                                                <i class="fas fa-code"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-paint-brush">
                                                <i class="fas fa-paint-brush"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-mobile-alt">
                                                <i class="fas fa-mobile-alt"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-chart-line">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-handshake">
                                                <i class="fas fa-handshake"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-users">
                                                <i class="fas fa-users"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-rocket">
                                                <i class="fas fa-rocket"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-shield-alt">
                                                <i class="fas fa-shield-alt"></i>
                                            </button>
                                            <button type="button" class="icon-option" data-icon="fas fa-cogs">
                                                <i class="fas fa-cogs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-toggle-on text-primary"></i>
                                        Estado
                                    </h5>
                                    
                                    <div class="form-check form-switch form-check-lg">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="is_active">
                                            Servicio Activo
                                        </label>
                                        <div class="form-text">Los servicios activos se muestran en el sitio web</div>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Crear Servicio
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Vista Previa -->
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 2rem;">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-eye me-2"></i>Vista Previa
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="preview-card">
                                <div class="preview-icon">
                                    <i id="preview-icon" class="fas fa-cog"></i>
                                </div>
                                <h6 id="preview-title">Título del Servicio</h6>
                                <p id="preview-description" class="text-muted small">
                                    La descripción aparecerá aquí...
                                </p>
                                <div>
                                    <span id="preview-status" class="badge bg-success">Activo</span>
                                    <span class="badge bg-secondary">Orden: <span id="preview-order">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const descriptionInput = document.getElementById('description');
            const iconInput = document.getElementById('icon');
            const orderInput = document.getElementById('order');
            const activeInput = document.getElementById('is_active');
            
            const previewTitle = document.getElementById('preview-title');
            const previewDescription = document.getElementById('preview-description');
            const previewIcon = document.getElementById('preview-icon');
            const previewStatus = document.getElementById('preview-status');
            const previewOrder = document.getElementById('preview-order');

            function updatePreview() {
                previewTitle.textContent = titleInput.value || 'Título del Servicio';
                previewDescription.textContent = descriptionInput.value || 'La descripción aparecerá aquí...';
                previewOrder.textContent = orderInput.value || '0';
                
                if (activeInput.checked) {
                    previewStatus.className = 'badge bg-success';
                    previewStatus.textContent = 'Activo';
                } else {
                    previewStatus.className = 'badge bg-secondary';
                    previewStatus.textContent = 'Inactivo';
                }
            }

            function updateIcon() {
                const iconClass = iconInput.value || 'fas fa-cog';
                previewIcon.className = iconClass;
            }

            // Event listeners
            titleInput.addEventListener('input', updatePreview);
            descriptionInput.addEventListener('input', updatePreview);
            iconInput.addEventListener('input', updateIcon);
            orderInput.addEventListener('input', updatePreview);
            activeInput.addEventListener('change', updatePreview);

            // Selector de iconos
            document.querySelectorAll('.icon-option').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const iconClass = this.dataset.icon;
                    iconInput.value = iconClass;
                    updateIcon();
                    
                    // Marcar como seleccionado
                    document.querySelectorAll('.icon-option').forEach(btn => {
                        btn.classList.remove('selected');
                    });
                    this.classList.add('selected');
                });
            });

            // Inicializar
            updatePreview();
            updateIcon();
        });
    </script>
</body>
</html>