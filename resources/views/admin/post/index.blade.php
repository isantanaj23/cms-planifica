@extends('admin.layouts.app')

@section('title', 'Gestión de Posts')

@section('header-actions')
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Post
    </a>
@endsection

@section('content')
<div class="row">
    <!-- Estadísticas -->
    <div class="col-12 mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-edit fa-2x text-primary mb-2"></i>
                        <h4 class="mb-0">{{ $stats['total'] }}</h4>
                        <small class="text-muted">Total Posts</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-eye fa-2x text-success mb-2"></i>
                        <h4 class="mb-0">{{ $stats['published'] }}</h4>
                        <small class="text-muted">Publicados</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-edit fa-2x text-warning mb-2"></i>
                        <h4 class="mb-0">{{ $stats['draft'] }}</h4>
                        <small class="text-muted">Borradores</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-2x text-info mb-2"></i>
                        <h4 class="mb-0">{{ $stats['scheduled'] }}</h4>
                        <small class="text-muted">Programados</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" 
                               placeholder="Título, contenido...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="status" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Programado</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archivado</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Categoría</label>
                        <select name="category" class="form-select">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary me-2">
                            <i class="fas fa-search"></i> Filtrar
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Limpiar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de Posts -->
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                @if($posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Post</th>
                                    <th>Categoría</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Vistas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($post->featured_image)
                                                    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" 
                                                         class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 40px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $post->title }}</h6>
                                                    <small class="text-muted">
                                                        por {{ $post->author->name }} • {{ $post->reading_time_text }}
                                                        @if($post->is_featured)
                                                            <span class="badge bg-warning text-dark ms-1">Destacado</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $post->category->color }}">
                                                {{ $post->category->name }}
                                            </span>
                                        </td>
                                        <td>{!! $post->status_badge !!}</td>
                                        <td>
                                            @if($post->published_at)
                                                <small>{{ $post->published_at->format('d/m/Y H:i') }}</small>
                                            @elseif($post->scheduled_at)
                                                <small class="text-info">
                                                    <i class="fas fa-clock"></i> {{ $post->scheduled_at->format('d/m/Y H:i') }}
                                                </small>
                                            @else
                                                <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="fas fa-eye"></i> {{ number_format($post->views_count) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($post->canBePublished() && $post->status == 'draft')
                                                    <form method="POST" action="{{ route('admin.posts.publish', $post) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="fas fa-share"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.posts.preview', $post) }}" target="_blank">
                                                                <i class="fas fa-external-link-alt me-2"></i>Vista previa
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.posts.duplicate', $post) }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-copy me-2"></i>Duplicar
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                                                                  onsubmit="return confirm('¿Estás seguro de eliminar este post?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash me-2"></i>Eliminar
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    <div class="p-3">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-edit fa-3x text-muted mb-3"></i>
                        <h5>No hay posts disponibles</h5>
                        <p class="text-muted">Comienza creando tu primer post del blog.</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Crear Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection