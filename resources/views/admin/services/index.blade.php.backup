@extends('admin.layouts.app')

@section('title', 'Gestión de Servicios')

@section('header-actions')
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Servicio
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lista de Servicios</h5>
            </div>
            <div class="card-body p-0">
                @if($services->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">{{ $service->name }}</h6>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 300px;">
                                                {{ $service->description }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($service->price)
                                                <span class="badge bg-success">${{ number_format($service->price, 2) }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($service->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-secondary">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $service->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este servicio?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    <div class="p-3">
                        {{ $services->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                        <h5>No hay servicios disponibles</h5>
                        <p class="text-muted">Comienza creando tu primer servicio.</p>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Crear Servicio
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection