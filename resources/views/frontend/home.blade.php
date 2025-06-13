<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planifica+ - Estrategias Empresariales</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #964ef9 0%, #472eff 50%, #3001ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            max-width: 600px;
            width: 90%;
        }
        .logo {
            font-size: 3rem;
            background: linear-gradient(135deg, #964ef9 0%, #472eff 50%, #3001ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #964ef9 0%, #472eff 50%, #3001ff 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 30px;
            font-weight: 600;
            margin: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(150, 78, 249, 0.4);
        }
        .btn-outline-primary {
            border: 2px solid #964ef9;
            color: #964ef9;
            border-radius: 15px;
            padding: 13px 30px;
            font-weight: 600;
            margin: 0.5rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #964ef9 0%, #472eff 50%, #3001ff 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-3px);
        }
        .status-badge {
            background: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: inline-block;
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="content-card">
        <div class="status-badge">
            <i class="fas fa-check-circle"></i> CMS Activo
        </div>
        
        <div class="logo">
            <i class="fas fa-chart-line"></i> Planifica+
        </div>
        
        <h2 class="mb-3">¡Sistema CMS Configurado!</h2>
        
        <p class="text-muted mb-4">
            El sistema de gestión de contenidos está funcionando correctamente. 
            Ahora puedes administrar todo el contenido de tu sitio web desde el panel de control.
        </p>

        <div class="d-flex flex-wrap justify-content-center">
            @auth
                @if(Auth::user()->is_admin)
                    <a href="/admin" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Panel de Administración
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="/login" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </a>
            @endauth
        </div>

        <hr class="my-4">

        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-cogs fa-2x text-primary mb-2"></i>
                <h6>CMS Completo</h6>
                <small class="text-muted">Sistema de gestión de contenidos</small>
            </div>
            <div class="col-md-4">
                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                <h6>Seguro</h6>
                <small class="text-muted">Autenticación y autorización</small>
            </div>
            <div class="col-md-4">
                <i class="fas fa-mobile-alt fa-2x text-info mb-2"></i>
                <h6>Responsive</h6>
                <small class="text-muted">Optimizado para todos los dispositivos</small>
            </div>
        </div>

        <div class="mt-4">
            <small class="text-muted">
                <strong>Próximo paso:</strong> Implementar el frontend de Planifica+ con el contenido dinámico del CMS
            </small>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>