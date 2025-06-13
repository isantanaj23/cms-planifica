@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Estadísticas -->
    <div class="col-12 mb-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-edit fa-2x text-primary mb-3"></i>
                        <h3 class="mb-0">{{ $stats['posts'] }}</h3>
                        <p class="text-muted mb-0">Posts</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-folder fa-2x text-info mb-3"></i>
                        <h3 class="mb-0">{{ $stats['categories'] }}</h3>
                        <p class="text-muted mb-0">Categorías</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-cogs fa-2x text-success mb-3"></i>
                        <h3 class="mb-0">{{ $stats['services'] }}</h3>
                        <p class="text-muted mb-0">Servicios</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x text-warning mb-3"></i>
                        <h3 class="mb-0">{{ $stats['users'] }}</h3>
                        <p class="text-muted mb-0">Usuarios</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de Bienvenida -->
    <div class="col-12">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">¡Bienvenido al Panel de Administración!</h4>
            <p>El sistema está funcionando correctamente. Puedes comenzar a gestionar tu contenido.</p>
            <hr>
            <p class="mb-0">
                <strong>Planifica+ CMS</strong> - Sistema de gestión de contenido
            </p>
        </div>
    </div>
</div>
@endsection